<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    // DatabaseSeeder.php
    public function run()
    {
        $this->call([
            ProdiSeeder::class,
            MatakuliahSeeder::class,
        ]);
    }
}
