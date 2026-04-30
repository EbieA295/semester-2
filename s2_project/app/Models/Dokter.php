<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;

    protected $table = 'dokters'; // Sesuaikan dengan nama tabel di database Anda (biasanya pakai 's' di akhir)

    protected $fillable = [
        'nama_dokter',
        'poliklinik_id',
        'foto_dokter'
    ];

    public function poliklinik()
    {
        return $this->belongsTo(Poliklinik::class, 'poliklinik_id');
    }
}