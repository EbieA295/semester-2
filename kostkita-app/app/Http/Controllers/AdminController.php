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
        // Mengambil semua unit agar admin bisa memantau status (Tersedia/Terisi/Dipesan)
        $units = \App\Models\Unit::all();

        // Mengambil semua booking terbaru dari customer untuk dikonfirmasi
        $bookings = \App\Models\Booking::latest()->get();

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

    public function update(Request $request, int $id)
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

    public function destroy(int $id)
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

        public function konfirmasiBooking(int $id)
    {
        $booking = \App\Models\Booking::find($id);
        if ($booking) {
            $booking->update(['status' => 'Confirmed']);

            // Otomatis ubah status unit menjadi Terisi
            \App\Models\Unit::where('id', $booking->unit_id)->update(['status' => 'Terisi']);
        }

        return back()->with('success', 'Booking telah dikonfirmasi!');
    }

    // Tambahkan di dalam class AdminController
    public function konfirmasi(int $id)
    {
        $booking = \App\Models\Booking::findOrFail($id);

        // Ambil data unit terkait untuk mendapatkan harganya
        $unit = \App\Models\Unit::find($booking->unit_id);

        // Update status booking dan isi total_harganya
        $booking->update([
            'status' => 'Confirmed',
            'total_harga' => $unit->harga ?? 0 // Pastikan kolom harga ada di tabel units
        ]);

        // Update status unit menjadi 'Terisi'
        if($unit) {
            $unit->update(['status' => 'Terisi']);
        }

        return redirect()->back()->with('success', 'Booking berhasil dikonfirmasi!');
    }
}
