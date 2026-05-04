<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unit;
use App\Models\Booking;

class PemilikController extends Controller
{
    public function index()
    {
        // Mengambil data untuk statistik dashboard
        $totalPendapatan = Booking::where('status', 'Confirmed')->sum('total_harga'); 
        $unitTersedia = Unit::where('status', 'Tersedia')->count();
        $unitTerisi = Unit::where('status', 'Terisi')->count();
        $bookingTerbaru = Booking::with('user', 'unit')->latest()->take(5)->get();

        // Mengirimkan variabel ke view pemilik.blade.php
        return view('pemilik.dashboard', compact(
            'totalPendapatan', 
            'unitTersedia', 
            'unitTerisi', 
            'bookingTerbaru'
        ));
    }
}