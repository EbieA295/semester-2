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
        // Gabungkan semua kolom dalam satu skema create
        Schema::create('poliklinik', function (Blueprint $table) {
            $table->id(); 
            $table->string('nama_poliklinik');
            $table->integer('total_pasien')->default(0); // Kolom tambahan Anda
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('poliklinik');
    }
};