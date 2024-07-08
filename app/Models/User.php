<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Menentukan primary key untuk model User.
     *
     * @var string
     */
    protected $primaryKey = 'id_user';

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array
     */
    protected $fillable = [
        'id_member',
        'nama',
        'email',
        'password',
        'no_hp',
        'role',
        'total_transaksi',
    ];

    /**
     * Definisi relasi untuk mengakses data Member terkait.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function member()
    {
        return $this->belongsTo(Member::class, 'id_member');
    }

    /**
     * Atribut yang disembunyikan dari array atau JSON representasi model.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Atribut yang akan dikonversi ke tipe asli (native types).
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
