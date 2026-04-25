<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    // Jika ID bukan angka (misal: A101), tambahkan 2 baris ini:
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id', 'tipe', 'lokasi', 'harga', 'status', 
        'penghuni', 'hp', 'checkin', 'catatan'
    ];
}