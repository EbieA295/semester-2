<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PemilikController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;
use App\Models\Unit;
use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;

// ==========================================
// 1. OTENTIKASI (LOGIN SATU PINTU)
// ==========================================

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/', function (Request $request) {
    $query = Unit::query();

    if ($request->has('tipe') && $request->tipe != 'Semua Tipe') {
        $query->where('tipe', $request->tipe);
    }

    if ($request->filled('harga_max')) {
        $query->where('harga', '<=', $request->harga_max);
    }

    if ($request->filled('lokasi')) {
        $query->where('lokasi', 'like', '%' . $request->lokasi . '%');
    }

    $semuaKamar = $query->get();
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
        
        // Wishlist & Review & Payment
        Route::post('/wishlist/{unit_id}', [WishlistController::class, 'toggle'])->name('customer.wishlist.toggle');
        Route::post('/review', [ReviewController::class, 'store'])->name('customer.review.store');
        Route::post('/upload-payment', [CustomerController::class, 'uploadPayment'])->name('customer.uploadPayment');
    });

    // Owner (Pemilik) routes
    Route::prefix('pemilik')->middleware(['role:owner'])->group(function () {
        Route::get('/', [PemilikController::class, 'index'])->name('pemilik.dashboard');
        Route::get('/laporan', [PemilikController::class, 'laporanKeuangan'])->name('pemilik.laporan');
        Route::get('/laporan/cetak', [PemilikController::class, 'exportLaporan'])->name('pemilik.laporan.cetak');
    });

    // Admin routes
    Route::prefix('admin')->middleware(['role:admin'])->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::post('/store', [AdminController::class, 'store']);
        Route::put('/update/{id}', [AdminController::class, 'update']);
        Route::delete('/destroy/{id}', [AdminController::class, 'destroy']);
        Route::post('/input-penyewa', [AdminController::class, 'checkIn']);
        Route::post('/konfirmasi/{id}', [AdminController::class, 'konfirmasiBooking'])->name('admin.konfirmasiBooking');
        Route::post('/confirm-payment/{id}', [AdminController::class, 'confirmPayment'])->name('admin.confirmPayment');
        
        // Fitur Baru: Kelola Penyewa & Laporan Keuangan
        Route::get('/penyewa', [AdminController::class, 'kelolaPenyewa'])->name('admin.penyewa');
        Route::get('/laporan', [AdminController::class, 'laporanKeuangan'])->name('admin.laporan');
        Route::get('/laporan/cetak', [AdminController::class, 'exportLaporan'])->name('admin.laporan.cetak');
    });


});

Route::get('/cek-bot', function () {
    try {
        $response = Telegram::getMe();
        return $response;
    } catch (\Exception $e) {
        return "Error: " . $e->getMessage();
    }
});

// Route untuk webhook (jika ingin menggunakan webhook)
Route::post('/telegram/webhook', function () {
    $update = Telegram::commandsHandler(true);
    return 'ok';
});

Route::get('/set-webhook', function () {
    try {
        $response = Telegram::setWebhook(['url' => url('/telegram/webhook')]);
        return $response;
    } catch (\Exception $e) {
        return "Error: " . $e->getMessage();
    }
});
