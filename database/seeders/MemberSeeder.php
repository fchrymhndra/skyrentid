<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('members')->insert([
            ['jenis_member' => 'biasa', 'diskon' => 0],
            ['jenis_member' => 'silver', 'diskon' => 15],
            ['jenis_member' => 'gold', 'diskon' => 25],
            ['jenis_member' => 'diamond', 'diskon' => 45],
        ]);
    }
}
