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

        // 2. CEK LOGIN UNTUK MYBOOKINGS
        $myBookings = collect();
        if (Auth::check()) {
            $myBookings = Booking::where('nama_penyewa', Auth::user()->name)->get();
        }

        return view('customer', compact('units', 'myBookings'));
    }

    public function storeBooking(Request $request)
    {
        $request->validate([
            'unit_id' => 'required|exists:units,id',
            'tgl_masuk' => 'required|date|after_or_equal:today',
        ]);

        $unit = Unit::findOrFail($request->unit_id);

        if ($unit->status !== 'Tersedia') {
            return back()->with('error', 'Maaf, kamar ini sudah tidak tersedia.');
        }

        // Simpan ke Database
        Booking::create([
            'unit_id' => $unit->id,
            'nama_penyewa' => Auth::user()->name,
            'no_hp' => Auth::user()->no_hp,
            'tgl_masuk' => $request->tgl_masuk,
            'total_harga' => $unit->harga,
            'status' => 'Pending'
        ]);

        // Update status unit
        $unit->update(['status' => 'Dipesan']);

        return back()->with('success', 'Booking berhasil! Silakan cek dashboard Anda untuk detail pembayaran.');
    }

    public function uploadPayment(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $booking = Booking::findOrFail($request->booking_id);

        if ($request->hasFile('payment_proof')) {
            $path = $request->file('payment_proof')->store('payments', 'public');
            $booking->update([
                'payment_proof' => $path,
                'payment_status' => 'Pending Verification'
            ]);
        }

        return back()->with('success', 'Bukti pembayaran berhasil diupload! Tunggu verifikasi admin.');
    }
}
