<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $primaryKey = 'id_member';

    protected $fillable = [
        'jenis_member',
        'diskon',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'id_member');
    }
}
