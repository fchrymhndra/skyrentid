<?php

namespace App\Exports;

use App\Models\Rental;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RentalsExport implements FromCollection, WithHeadings, ShouldAutoSize, WithMapping, WithEvents
{
    /**
     * Menentukan data yang diekspor
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $rentals = Rental::with(['user', 'product'])
                    ->whereIn('status_kembali', ['done', 'rejected'])
                    ->get();

        $data = $rentals->map(function ($rental, $index) {
            return [
                'No' => $index + 1,
                'Nama Customer' => $rental->user->nama,
                'Nama Produk' => $rental->product->nama_produk,
                'Jaminan' => $rental->jaminan,
                'Tanggal Sewa' => \Carbon\Carbon::parse($rental->rental_date)->format('d/m/Y'),
                'Tanggal Kembali' => \Carbon\Carbon::parse($rental->return_date)->format('d/m/Y'),
                'Metode Pembayaran' => $rental->payment_method,
                'Denda' => 'Rp ' . number_format($rental->denda, 0, ',', '.'),
                'Total' => 'Rp ' . number_format($rental->total, 0, ',', '.'),
                'Status Pinjam' => $rental->status_pinjam,
                'Status Kembali' => $rental->status_kembali,
            ];
        });

        return $data;
    }

    /**
     * Menentukan heading kolom
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'No',
            'Nama Customer',
            'Nama Produk',
            'Jaminan',
            'Tanggal Sewa',
            'Tanggal Kembali',
            'Metode Pembayaran',
            'Denda',
            'Total',
            'Status Pinjam',
            'Status Kembali'
        ];
    }

    /**
     * Mapping data untuk penulisan format tertentu
     *
     * @param mixed $row
     * @return array
     */
    public function map($row): array
    {
        return [
            $row['No'],
            $row['Nama Customer'],
            $row['Nama Produk'],
            $row['Jaminan'],
            $row['Tanggal Sewa'],
            $row['Tanggal Kembali'],
            $row['Metode Pembayaran'],
            $row['Denda'],
            $row['Total'],
            $row['Status Pinjam'],
            $row['Status Kembali'],
        ];
    }

    /**
     * Mendefinisikan event setelah sheet selesai dibuat
     *
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                // Mengatur semua sel agar berada di tengah dan menggunakan font Verdana
                $event->sheet->getDelegate()->getStyle('A1:K1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'name' => 'Verdana',
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                ]);

                // Menambahkan border untuk semua sel
                $event->sheet->getDelegate()->getStyle('A1:K' . $event->sheet->getDelegate()->getHighestRow())
                    ->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
            },
        ];
    }
}
