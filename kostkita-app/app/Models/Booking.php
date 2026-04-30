<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = ['unit_id', 'nama_penyewa', 'no_hp', 'tgl_masuk', 'tgl_keluar', 'status_pembayaran'];
}