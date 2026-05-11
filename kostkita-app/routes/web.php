<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PemilikController;
use Illuminate\Support\Facades\Route;
use App\Models\Unit;

// ==========================================
// 1. OTENTIKASI (LOGIN SATU PINTU)
// ==========================================

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/', function () {
    $semuaKamar = unit::all();
    return view('welcome', compact('semuaKamar'));
});

Route::get('/register', [LoginController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [LoginController::class, 'register']);

// ==========================================
// 2. RUTE TERPROTEKSI (WAJIB LOGIN)
// ==========================================

Route::middleware(['auth'])->group(function () {

    //CUST
    Route::post('/customer/booking', [CustomerController::class, 'storeBooking'])->name('customer.booking');
    Route::get('/customer', [CustomerController::class, 'index'])->name('customer.dashboard');

    //PEMILIK
    Route::get('/pemilik', [PemilikController::class, 'index'])->name('pemilik.dashboard');

    // MANAJEMEN ADMIN
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('/admin/store', [AdminController::class, 'store']);
    Route::delete('/admin/destroy/{id}', [AdminController::class, 'destroy']);
    Route::post('/admin/input-penyewa', [AdminController::class, 'checkIn']);
    Route::post('/admin/konfirmasi/{id}', [AdminController::class, 'konfirmasiBooking'])->name('admin.konfirmasi');
    Route::post('/admin/konfirmasi/{id}', [AdminController::class, 'konfirmasiBooking'])->name('admin.konfirmasiBooking');
});
