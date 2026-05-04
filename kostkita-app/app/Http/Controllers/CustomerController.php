<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unit;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        // Mulai query dari model Unit
        $query = \App\Models\Unit::query();
    
        // Filter berdasarkan Tipe (Putra/Putri)
        if ($request->has('tipe') && $request->tipe != 'Semua Tipe') {
            $query->where('tipe', $request->tipe);
        }
    
        // Filter berdasarkan Harga Maksimal
        if ($request->has('harga_max')) {
            $query->where('harga', '<=', $request->harga_max);
        }
    
        $units = $query->get();
        $myBookings = \App\Models\Booking::where('nama_penyewa', auth()->user()->name)->get();
    
        return view('customer', compact('units', 'myBookings'));
    }

        public function storeBooking(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'unit_id' => 'required',
            'tgl_masuk' => 'required|date',
        ]);
    
        // 2. Simpan data ke tabel bookings
        \App\Models\Booking::create([
            'unit_id' => $request->unit_id,
            'nama_penyewa' => auth()->user()->name, // Mengambil nama dari user yang login
            'tgl_masuk' => $request->tgl_masuk,
            'status' => 'Pending' // Status awal seperti di Agoda
        ]);
    
        // 3. Ubah status unit menjadi 'Dipesan'
        \App\Models\Unit::where('id', $request->unit_id)->update(['status' => 'Dipesan']);
    
        return back()->with('success', 'Booking berhasil! Silahkan tunggu konfirmasi.');
    }
}