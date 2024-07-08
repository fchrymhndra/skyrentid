<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Rental;
use App\Models\Product;
use App\Models\User;
use App\Exports\RentalsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RentalController extends Controller
{
    public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'id_produk' => 'required|exists:products,id_produk',
        'id_user' => 'required|exists:users,id_user',
        'jaminan' => 'required',
        'rental_date' => 'required|date',
        'return_date' => 'required|date|after_or_equal:rental_date',
        'payment_method' => 'required',
    ]);

    // Mendapatkan harga produk dari database
    $product = Product::findOrFail($request->get('id_produk'));
    $hargaProdukPerHari = $product->harga_produk;

    // Mendapatkan diskon dari user
    $user = User::with('member')->findOrFail($request->get('id_user'));
    $diskon = $user->member ? $user->member->diskon : 0;

    // Menghitung jumlah hari sewa
    $rentalDate = new \DateTime($request->get('rental_date'));
    $returnDate = new \DateTime($request->get('return_date'));
    $diff = $rentalDate->diff($returnDate);
    $jumlahHariSewa = $diff->days;

    // Menghitung total berdasarkan harga produk per hari
    $total = $hargaProdukPerHari * $jumlahHariSewa;

    // Menghitung total setelah diskon
    $discountAmount = ($diskon / 100) * $total;
    $totalAfterDiscount = $total - $discountAmount;

    // Create new Rental object
    $rental = new Rental([
        'id_produk' => $request->get('id_produk'),
        'id_user' => $request->get('id_user'),
        'jaminan' => $request->get('jaminan'),
        'rental_date' => $rentalDate,
        'return_date' => $returnDate,
        'payment_method' => $request->get('payment_method'),
        'total' => $totalAfterDiscount,  // Save the discounted total
        'status_pinjam' => 'Pending',
        'status_kembali' => 'Pending',
    ]);

    // Save rental to database
    $rental->save();

    // Log untuk debug
    Log::info('Rental saved successfully.');

    // Redirect atau response JSON
    return response()->json(['message' => 'Rental data saved successfully'], 200);
}


    public function showConfirmation()
    {
        // Ambil semua penyewaan yang belum dikonfirmasi
        $rentals = Rental::with(['user', 'product'])->where('status_pinjam', 'Pending')->get();

        return view('admin.konfirmasi.konfsewa', compact('rentals'));
    }

    public function showReturnConfirmation()
    {
        // Ambil semua pengembalian yang belum dikonfirmasi
        $rentals = Rental::with(['user', 'product'])->where('status_pinjam', 'Done')->where('status_kembali', 'Pending')->get();

        return view('admin.konfirmasi.konfkembali', compact('rentals'));
    }

    public function confirmRental($id_order)
    {
        // Temukan rental berdasarkan ID
        $rental = Rental::findOrFail($id_order);

        // Update status_pinjam menjadi 'Done'
        $rental->status_pinjam = 'Done';
        $rental->save();

        // Kurangi stok produk
        $product = Product::findOrFail($rental->id_produk);
        $product->stok_produk -= 1;

        // Jika stok produk menjadi 0, ubah status_produk menjadi 'off'
        if ($product->stok_produk <= 0) {
            $product->status_produk = 'off';
        }

        // Simpan perubahan pada produk
        $product->save();

        // Buat template pesan WhatsApp untuk konfirmasi
        $whatsappMessage = "Halo, " . $rental->user->nama . ". Penyewaan produk " . $rental->product->nama_produk . " Anda telah disetujui. Terima kasih!";

        // Redirect atau response JSON dengan template pesan
        return redirect()->route('admin.konfirmasi.konfsewa')
            ->with('success', 'Rental confirmed successfully. <a href="https://wa.me/' . $rental->user->no_hp . '?text=' . urlencode($whatsappMessage) . '" target="_blank">Kirim WhatsApp</a>');
    }

    public function rejectRental($id_order)
    {
        // Temukan rental berdasarkan ID
        $rental = Rental::findOrFail($id_order);

        // Update status_pinjam menjadi 'Rejected'
        $rental->status_pinjam = 'Rejected';
        $rental->status_kembali = 'Rejected';
        $rental->save();

        // Buat template pesan WhatsApp untuk penolakan
        $whatsappMessage = "Halo, " . $rental->user->nama . ". Mohon maaf, penyewaan produk " . $rental->product->nama_produk . " Anda telah ditolak.";

        // Redirect atau response JSON dengan template pesan
        return redirect()->route('admin.konfirmasi.konfsewa')
            ->with('success', 'Rental rejected successfully. <a href="https://wa.me/' . $rental->user->no_hp . '?text=' . urlencode($whatsappMessage) . '" target="_blank">Kirim WhatsApp</a>');
    }

    public function updateDenda(Request $request, $id_order)
{
    // Validasi input denda
    $request->validate([
        'denda' => 'required|numeric|min:0',
    ]);

    // Temukan rental berdasarkan ID
    $rental = Rental::findOrFail($id_order);

    // Update denda
    $rental->denda = $request->input('denda');
    $rental->save();

    // Hitung total baru
    $newTotal = $rental->total + $rental->denda;

    return redirect()->route('admin.konfirmasi.konfkembali')->with('success', 'Denda updated successfully.');
}


public function confirmReturn(Request $request, $id_order)
{
    // Temukan rental berdasarkan ID
    $rental = Rental::findOrFail($id_order);

    // Update total dengan menambahkan denda
    $rental->total += $rental->denda;
    $rental->status_kembali = 'Done';
    $rental->save();

    // Tambah stok produk
    $product = Product::findOrFail($rental->id_produk);
    $product->stok_produk += 1;

    // Jika produk sebelumnya dinonaktifkan karena stok 0, aktifkan kembali produk
    if ($product->stok_produk > 0 && $product->status_produk == 'off') {
        $product->status_produk = 'on';
    }

    // Tambahkan total_disewa pada produk
    $product->total_disewa += 1;

    // Simpan perubahan pada produk
    $product->save();

    // Ambil user yang melakukan rental
    $user = User::findOrFail($rental->id_user);

    // Hitung total_transaksi baru
    $totalTransaksiBaru = $user->total_transaksi + $rental->total;

    // Update total_transaksi pada user
    $user->update(['total_transaksi' => $totalTransaksiBaru]);

    return redirect()->route('admin.konfirmasi.konfkembali')->with('success', 'Return confirmed successfully.');
}


    public function showReport(Request $request)
    {
        $query = Rental::with(['user', 'product']);

        // Apply filters
        if ($request->has('month') && $request->month != '') {
            $query->whereMonth('return_date', $request->month);
        }

        if ($request->has('year') && $request->year != '') {
            $query->whereYear('return_date', $request->year);
        }

        $rentals = $query->where(function($query) {
            $query->where('status_pinjam', 'Done')
                ->orWhere('status_kembali', 'Done');
        })->get();

        return view('admin.laporan.laporan', compact('rentals'));
    }

    public function export()
    {
        $date = Carbon::now()->format('Y-m-d');
        $fileName = 'LaporanSewa_' . $date . '.xlsx';

        return Excel::download(new RentalsExport, $fileName);
    }
}