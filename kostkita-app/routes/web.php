<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PemilikController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\WishlistController;
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

    // Customer routes
    Route::prefix('customer')->middleware(['role:customer'])->group(function () {
        Route::post('/booking', [CustomerController::class, 'storeBooking'])->name('customer.booking');
        Route::get('/', [CustomerController::class, 'index'])->name('customer.dashboard');
        
        // Wishlist & Review
        Route::post('/wishlist/{unit_id}', [WishlistController::class, 'toggle'])->name('customer.wishlist.toggle');
        Route::post('/review', [ReviewController::class, 'store'])->name('customer.review.store');
    });

    // Owner (Pemilik) routes
    Route::prefix('pemilik')->middleware(['role:owner'])->group(function () {
        Route::get('/', [PemilikController::class, 'index'])->name('pemilik.dashboard');
    });

    // Admin routes
    Route::prefix('admin')->middleware(['role:admin'])->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::post('/store', [AdminController::class, 'store']);
        Route::delete('/destroy/{id}', [AdminController::class, 'destroy']);
        Route::post('/input-penyewa', [AdminController::class, 'checkIn']);
        Route::post('/konfirmasi/{id}', [AdminController::class, 'konfirmasiBooking'])->name('admin.konfirmasiBooking');
    });
});
