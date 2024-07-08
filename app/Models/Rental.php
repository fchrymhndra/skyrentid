<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_order';

    protected $fillable = [
        'id_produk', 
        'id_user', 
        'jaminan', 
        'rental_date', 
        'return_date',
        'payment_method', 
        'denda', 
        'total', 
        'status_pinjam', 
        'status_kembali'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_produk');
    }
}

