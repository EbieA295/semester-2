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
        // 1. Ambil data unit dengan filter
        $query = Unit::query();

        if ($request->has('tipe') && $request->tipe != 'Semua Tipe') {
            $query->where('tipe', $request->tipe);
        }

        if ($request->filled('harga_max')) {
            $query->where('harga', '<=', $request->harga_max);
        }

        $units = $query->get();

        // 2. CEK LOGIN UNTUK MYBOOKINGS (Penting!)
        // Jika tidak login, kita kasih array kosong agar view tidak error
        $myBookings = collect();
        if (Auth::check()) {
            $myBookings = Booking::where('nama_penyewa', Auth::user()->name)->get();
        }

        return view('customer', compact('units', 'myBookings'));
    }

    public function storeBooking(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silahkan login terlebih dahulu');
        }

        $request->validate([
            'unit_id' => 'required',
            'tgl_masuk' => 'required|date',
            'no_hp' => 'required',
        ]);

        // 1. Ambil data unit untuk mendapatkan harganya
        $unit = Unit::where('id', $request->unit_id)->first();

        // 2. Simpan ke Database dengan total_harga
        Booking::create([
            'unit_id' => $request->unit_id,
            'nama_penyewa' => Auth::user()->name,
            'no_hp' => $request->no_hp,
            'tgl_masuk' => $request->tgl_masuk,
            'total_harga' => $unit->harga, // AMBIL HARGA DARI TABEL UNIT
            'status' => 'Pending'
        ]);

        // 3. Update status unit
        Unit::where('id', $request->unit_id)->update(['status' => 'Dipesan']);

        return back()->with('success', 'Booking berhasil! Tunggu konfirmasi Admin.');
    }
}
