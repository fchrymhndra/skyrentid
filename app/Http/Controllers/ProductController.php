<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.produk.produk', compact('products'));
    }

    public function create()
    {
        return view('admin.produk.createproduk');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required',
            'nama_produk' => 'required',
            'deskripsi_produk' => 'required',
            'stok_produk' => 'required|integer',
            'harga_produk' => 'required|numeric',
            'foto_produk' => 'image|nullable|max:1999',
            'status_produk' => 'required',
        ]);

        if ($request->hasFile('foto_produk')) {
            $fileNameWithExt = $request->file('foto_produk')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('foto_produk')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            $path = $request->file('foto_produk')->storeAs('public/foto_produk', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        $product = new Product([
            'kategori' => $request->get('kategori'),
            'nama_produk' => $request->get('nama_produk'),
            'deskripsi_produk' => $request->get('deskripsi_produk'),
            'stok_produk' => $request->get('stok_produk'),
            'harga_produk' => $request->get('harga_produk'),
            'foto_produk' => $fileNameToStore,
            'status_produk' => $request->get('status_produk'),
            'riwayat_service' => $request->get('riwayat_service'),
            'total_disewa' => $request->get('total_disewa'),
        ]);

        $product->save();

        return redirect('/produk')->with('success', 'Product saved!');
    }

    public function show($id_produk)
    {
        $product = Product::find($id_produk);
        return view('admin.produk.showproduk', compact('product'));
    }

    public function edit($id_produk)
    {
        $product = Product::find($id_produk);
        return view('admin.produk.editproduk', compact('product'));
    }

    public function update(Request $request, $id_produk)
    {
        // Validasi data
        $request->validate([
            'kategori' => 'required',
            'nama_produk' => 'required',
            'deskripsi_produk' => 'required',
            'stok_produk' => 'required|integer',
            'harga_produk' => 'required|numeric',
            'foto_produk' => 'image|nullable|max:1999',
        ]);

        // Mengambil data produk berdasarkan id
        $product = Product::find($id_produk);

        // Mengisi data yang akan diperbarui
        $product->kategori = $request->input('kategori');
        $product->nama_produk = $request->input('nama_produk');
        $product->deskripsi_produk = $request->input('deskripsi_produk');
        $product->stok_produk = $request->input('stok_produk');
        $product->harga_produk = $request->input('harga_produk');
        $product->riwayat_service = $request->input('riwayat_service');
        $product->total_disewa = $request->input('total_disewa');

        // Mengunggah file foto_produk baru jika ada
        if ($request->hasFile('foto_produk')) {
            $fileName = $request->file('foto_produk')->getClientOriginalName();
            $fileNameToStore = time() . '_' . $fileName;
            $path = $request->file('foto_produk')->storeAs('public/foto_produk', $fileNameToStore);
            $product->foto_produk = $fileNameToStore;
        }

        // Menyimpan perubahan
        $product->save();

        // Redirect ke halaman produk dengan pesan sukses
        return redirect('/produk')->with('success', 'Product updated successfully!');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status_produk' => 'required|in:on,off',
        ]);

        $product = Product::find($id);
        if ($product) {
            $product->status_produk = $request->status_produk;
            $product->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }
    
    public function destroy($id_produk)
    {
        $product = Product::find($id_produk);
        $product->delete();

        return redirect('/produk')->with('success', 'Product deleted!');
    }
}
