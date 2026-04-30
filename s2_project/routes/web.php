<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PoliklinikController;
use App\Http\Controllers\DokterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', [AdminController::class, 'admin'])->name('dashboard-admin');

Route::get('/petugas', [AdminController::class, 'petugas'])->name('dashboard-petugas');

Route::get('/pasien', [AdminController::class, 'pasien'])->name('dashboard-pasien');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


//poliklinik
Route::get('/poliklinik/create', [PoliklinikController::class, 'create'])->name('poliklinik.create');
Route::post('/poliklinik/add', [PoliklinikController::class, 'add'])->name('poliklinik.add');
Route::get('/poliklinik', [PoliklinikController::class, 'index'])->name('poliklinik.index');
Route::get('/poliklinik/{id}/edit', [PoliklinikController::class, 'edit'])->name('poliklinik.edit');
Route::put('/poliklinik/{id}', [PoliklinikController::class, 'update'])->name('poliklinik.update');
Route::delete('/poliklinik/{id}', [PoliklinikController::class, 'destroy'])->name('poliklinik.destroy');

//Dokter
Route::get('/dokter', [DokterController::class, 'index'])->name('dokter.index');
Route::get('/dokter/create', [DokterController::class, 'create'])->name('dokter.create');
Route::post('/dokter/add', [DokterController::class, 'add'])->name('dokter.add');
Route::delete('/dokter/{id}', [DokterController::class, 'destroy'])->name('dokter.destroy');
Route::get('/dokter/edit/{id}', [DokterController::class, 'edit'])->name('dokter.edit');
Route::put('/dokter/update/{id}', [DokterController::class, 'update'])->name('dokter.update');
Route::get('/dokter/{id}', [DokterController::class, 'show'])->name('dokter.show');