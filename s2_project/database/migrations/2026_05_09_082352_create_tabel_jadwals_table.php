<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Nama tabel diubah menjadi 'tabel_jadwals' agar sesuai dengan database kamu
        Schema::create('tabel_jadwals', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique();
            $table->foreignId('dokter_id')->constrained('dokters')->onDelete('cascade');
            $table->foreignId('poliklinik_id')->constrained('poliklinik')->onDelete('cascade');
            $table->date('tanggal_praktek');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->integer('jumlah');
            $table->timestamps();
        });
    }

    public function down()
    {
        // Sesuaikan juga di sini agar saat rollback tidak error
        Schema::dropIfExists('tabel_jadwals');
    }
};
