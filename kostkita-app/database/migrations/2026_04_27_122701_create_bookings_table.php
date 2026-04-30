<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            
            // Sesuaikan tipe data unit_id dengan primary key di tabel units
            // Jika ID unit adalah string (seperti A101), gunakan string
            $table->string('unit_id');
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');
            
            $table->string('nama_penyewa');
            $table->string('no_hp');
            $table->date('tgl_masuk');
            $table->date('tgl_keluar')->nullable();
            $table->enum('status_pembayaran', ['Lunas', 'Belum Bayar'])->default('Belum Bayar');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
