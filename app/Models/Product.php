<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Menentukan primary key 
    protected $primaryKey = 'id_produk';

    protected $fillable = [
        'kategori',
        'nama_produk',
        'deskripsi_produk',
        'stok_produk',
        'harga_produk',
        'foto_produk',
        'status_produk',
        'riwayat_service',
        'total_disewa',
    ];

    // Optional: Define relationships, accessors, mutators, etc.

    // Example accessor for image path
    public function getFotoProdukAttribute($value)
    {
        // Assume 'foto_produk' stores image filename
        return asset('storage/foto_produk/' . $value);
    }
}
