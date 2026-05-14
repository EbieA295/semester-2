<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unit;
use App\Models\Booking;

class PemilikController extends Controller
{
    public function index()
    {
        $totalPendapatan = Booking::where('status', 'Confirmed')->sum('total_harga');
        $unitTersedia = Unit::where('status', 'Tersedia')->count();
        $unitTerisi = Unit::where('status', 'Terisi')->count();
        $menungguKonfirmasi = Booking::where('status', 'Pending')->count();

        // Hapus 'user' dari with(), cukup 'unit' saja jika relasinya sudah ada
        $bookingTerbaru = Booking::latest()->take(5)->get();
        $semuaUnit = Unit::latest()->take(5)->get();

        return view('pemilik.dashboard', compact(
            'totalPendapatan',
            'unitTersedia',
            'unitTerisi',
            'bookingTerbaru',
            'semuaUnit',
            'menungguKonfirmasi'
        ));
    }
}
