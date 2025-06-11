<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // ProdiSeeder.php
    public function run()
    {
        DB::table('prodi')->insert([
            ['nama' => 'Teknologi Informasi'], // 
            ['nama' => 'Sistem Informasi'], // 
            ['nama' => 'Pendidikan Teknologi Informasi'], // 
            ['nama' => 'Teknik Informatika'], // 
            ['nama' => 'Teknik Komputer'], // 
        ]);
    }
}