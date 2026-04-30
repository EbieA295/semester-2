<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unit;
use App\Models\Booking;
use Illuminate\Support\Facades\DB; // Tambahkan ini untuk Transaction

class AdminController extends Controller
{
    public function index()
    {
        $units = \App\Models\Unit::all();
    // Ambil 5 transaksi terbaru untuk ditampilkan di tabel
    $bookings = \App\Models\Booking::latest()->take(5)->get(); 

    return view('admin', compact('units', 'bookings'));

    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|unique:units,id',
            'tipe' => 'required',
            'lokasi' => 'required',
            'harga' => 'required|numeric',
            'status' => 'required'
        ]);

        Unit::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Unit berhasil ditambahkan'
        ]);
    }

    public function update(Request $request, $id)
    {
        $unit = Unit::findOrFail($id);

        $validated = $request->validate([
            'tipe' => 'required',
            'lokasi' => 'required',
            'harga' => 'required|numeric',
            'status' => 'required'
        ]);

        $unit->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Unit berhasil diupdate'
        ]);
    }

    public function destroy($id)
    {
        $unit = Unit::findOrFail($id);
        $unit->delete();

        return response()->json([
            'success' => true,
            'message' => 'Unit berhasil dihapus'
        ]);
    }

    public function checkIn(Request $request)
    {
        $request->validate([
            'unit_id' => 'required|exists:units,id',
            'nama_penyewa' => 'required',
            'no_hp' => 'required',
            'tgl_masuk' => 'required|date',
        ]);

        // Menggunakan Transaction agar data konsisten
        DB::beginTransaction();

        try {
            // 1. Simpan data ke tabel bookings
            Booking::create([
                'unit_id' => $request->unit_id,
                'nama_penyewa' => $request->nama_penyewa,
                'no_hp' => $request->no_hp,
                'tgl_masuk' => $request->tgl_masuk,
                'status_pembayaran' => 'Belum Bayar'
            ]);

            // 2. Ubah status unit menjadi 'Terisi'
            Unit::where('id', $request->unit_id)->update(['status' => 'Terisi']);

            DB::commit(); // Simpan permanen jika keduanya sukses
            return response()->json(['success' => true, 'message' => 'Check-in berhasil!']);

        } catch (\Exception $e) {
            DB::rollback(); // Batalkan jika ada salah satu yang gagal
            return response()->json(['success' => false, 'message' => 'Gagal: ' . $e->getMessage()], 500);
        }
    }
}