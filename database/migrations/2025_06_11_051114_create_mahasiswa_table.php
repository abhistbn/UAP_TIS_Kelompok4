<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->string('nim')->primary(); // nim (PK, string)
            $table->string('nama'); // nama (string)
            $table->integer('angkatan'); // angkatan (int)
            $table->string('password'); // password (string)
            $table->foreignId('prodi_id')->constrained('prodi'); // foreign key ke tabel prodis
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};
