<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// 1. Halaman Utama & User (Opsional)
Route::get('/', function () { return view('welcome'); });
Route::get('/customer', function () { return view('customer'); });
Route::get('/pemilik', function () { return view('pemilik'); });

// 2. Rute Manajemen Admin
Route::get('/admin', [AdminController::class, 'index']); // Menampilkan Dashboard
Route::post('/admin/store', [AdminController::class, 'store']); // Tambah Kamar Baru
Route::delete('/admin/destroy/{id}', [AdminController::class, 'destroy']); // Hapus Kamar

// 3. Rute Proses Penyewa (Check-in)
// Alamat ini HARUS sama dengan yang dipanggil di JavaScript 'fetch'
Route::post('/admin/input-penyewa', [AdminController::class, 'checkIn']);