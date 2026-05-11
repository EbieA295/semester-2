<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'unit_id',
        'nama_penyewa',
        'no_hp',
        'tgl_masuk',
        'status',
        'total_harga',
        'payment_proof',
        'payment_status',
    ];

    /**
     * Relasi ke model User
     * Karena kamu menggunakan 'nama_penyewa', kita sambungkan ke kolom 'name' di tabel users.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'nama_penyewa', 'name');
    }

    /**
     * Relasi ke model Unit
     * Agar statistik kamar di dashboard pemilik bisa muncul.
     */
    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
}