<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPoliklinik extends Model
{
    use HasFactory;

    /**
     * Menghubungkan model ini ke tabel 'tabel_jadwals' di database.
     * Sesuai dengan nama tabel yang terlihat di phpMyAdmin.
     */
    protected $table = 'tabel_jadwals';

    /**
     * Boot function untuk auto-generate kode jadwal secara otomatis.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Membuat kode unik otomatis saat data disimpan
            $model->kode = 'JADWAL-' . strtoupper(uniqid());
        });
    }

    /**
     * Relasi ke Model Dokter
     */
    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'dokter_id');
    }

    /**
     * Relasi ke Model Poliklinik
     */
    public function poliklinik()
    {
        return $this->belongsTo(Poliklinik::class, 'poliklinik_id');
    }
}
