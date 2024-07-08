<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'id_member' => '1',
            'nama' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('12345678'), // Replace 'password' with your desired admin password
            'no_hp' => '1234567890', // Replace with desired phone number
            'role' => 'admin', // Role set to 'admin'
            'total_transaksi' => null, // Can be set to a default value or null
        ]);
    }
}
