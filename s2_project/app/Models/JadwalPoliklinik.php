<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPoliklinik extends Model
{
    protected $table = 'jadwal_poliklinik';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->kode = 'JADWAL-' . strtoupper(uniqid());
        });
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'dokter_id');
    }

    public function poliklinik()
    {
        return $this->belongsTo(Poliklinik::class, 'poliklinik_id');
    }
}