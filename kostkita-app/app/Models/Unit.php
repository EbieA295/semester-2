<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    // Jika ID bukan angka (misal: A101), tambahkan 2 baris ini:
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id', 'tipe', 'lokasi', 'harga', 'status', 'image',
        'penghuni', 'hp', 'checkin', 'catatan'
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class, 'unit_id', 'id');
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class, 'unit_id', 'id');
    }

    public function getAverageRatingAttribute()
    {
        return $this->reviews()->avg('rating') ?: 0;
    }

    public function isWishlistedBy($userId)
    {
        return $this->wishlists()->where('user_id', $userId)->exists();
    }
}