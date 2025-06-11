<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MatakuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // MatakuliahSeeder.php
    public function run()
    {
        DB::table('matakuliah')->insert([
            ['nama' => 'Pemrograman Dasar'], // 
            ['nama' => 'Pemrograman Lanjut'], // 
            ['nama' => 'Algoritma dan Struktur Data'], // 
            ['nama' => 'Sistem Basis Data'], // 
            ['nama' => 'Jaringan Komputer Dasar'], // 
   ]);
}
}