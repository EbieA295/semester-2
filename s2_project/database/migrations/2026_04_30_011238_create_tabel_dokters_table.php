<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Gunakan 'dokters' (huruf kecil semua) agar sesuai dengan standar Laravel
        Schema::create('dokters', function (Blueprint $table) {
            $table->id();
            $table->string('nama_dokter');
            // Pastikan penulisan foreignId menggunakan camelCase yang benar
            $table->foreignId('poliklinik_id')->constrained('poliklinik')->onDelete('cascade');
            $table->string('foto_dokter')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Nama tabel di sini HARUS SAMA dengan yang ada di fungsi up()
        Schema::dropIfExists('dokters');
    }
};