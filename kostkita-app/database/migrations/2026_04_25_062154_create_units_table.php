<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('units', function (Blueprint $table) {
            $table->string('id')->primary(); // Menggunakan string untuk kode unik (A101, B201)
            $table->string('tipe');
            $table->string('lokasi');
            $table->decimal('harga', 12, 2);
            $table->string('status');
            $table->string('penghuni')->nullable();
            $table->string('hp')->nullable();
            $table->date('checkin')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('units');
    }
};