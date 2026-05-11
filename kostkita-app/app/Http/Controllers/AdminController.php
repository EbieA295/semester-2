<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unit;
use App\Models\Booking;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreUnitRequest;
use App\Http\Requests\UpdateUnitRequest;
use App\Http\Requests\CheckInRequest;
use Illuminate\Support\Facades\Storage;

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

    public function store(StoreUnitRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('units', 'public');
        }

        Unit::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Unit berhasil ditambahkan'
        ]);
    }

    public function update(UpdateUnitRequest $request, int $id)
    {
        $unit = Unit::findOrFail($id);
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($unit->image) {
                Storage::disk('public')->delete($unit->image);
            }
            $validated['image'] = $request->file('image')->store('units', 'public');
        }

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

    public function checkIn(CheckInRequest $request)
    {
        $validated = $request->validated();

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
        $booking = Booking::findOrFail($id);
        $unit = Unit::find($booking->unit_id);

        // Update status booking dan isi total_harganya
        $booking->update([
            'status' => 'Confirmed',
            'total_harga' => $unit->harga ?? 0
        ]);

        // Update status unit menjadi 'Terisi'
        if ($unit) {
            $unit->update(['status' => 'Terisi']);
        }

        return redirect()->back()->with('success', 'Booking berhasil dikonfirmasi!');
    }
}
