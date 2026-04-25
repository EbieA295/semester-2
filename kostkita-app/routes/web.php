<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// 1. Rute Admin (WAJIB LEWAT CONTROLLER)
Route::get('/admin', [AdminController::class, 'index']);

// 2. Rute Lainnya
Route::get('/', function () {
    return view('welcome');
});

Route::get('/customer', function () {
    return view('customer');
});

Route::get('/pemilik', function () {
    return view('pemilik');
});