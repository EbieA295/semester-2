<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unit;
use App\Models\Booking;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreUnitRequest;
use App\Http\Requests\UpdateUnitRequest;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $units = Unit::all();
        $bookings = Booking::latest()->get();
        
        // Statistik
        $totalUnits = $units->count();
        $availableUnits = $units->where('status', 'Tersedia')->count();
        $occupiedUnits = $units->where('status', 'Terisi')->count();
        $pendingBookings = $bookings->where('status', 'Pending')->count();

        return view('admin', compact('units', 'bookings', 'totalUnits', 'availableUnits', 'occupiedUnits', 'pendingBookings'));
    }

    public function store(StoreUnitRequest $request)
    {
        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('units', 'public');
        }
        Unit::create($validated);
        return response()->json(['success' => true, 'message' => 'Unit berhasil ditambahkan']);
    }

    public function update(UpdateUnitRequest $request, $id)
    {
        $unit = Unit::findOrFail($id);
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($unit->image) {
                Storage::disk('public')->delete($unit->image);
            }
            $validated['image'] = $request->file('image')->store('units', 'public');
        }

        $unit->update($validated);

        return response()->json(['success' => true, 'message' => 'Unit berhasil diupdate']);
    }

    public function destroy($id)
    {
        $unit = Unit::findOrFail($id);
        if ($unit->image) {
            Storage::disk('public')->delete($unit->image);
        }
        $unit->delete();
        return response()->json(['success' => true, 'message' => 'Unit berhasil dihapus']);
    }

    public function konfirmasiBooking(int $id)
    {
        $booking = Booking::findOrFail($id);
        
        // Admin menyetujui request, sekarang menunggu pembayaran
        $booking->update([
            'status' => 'Waiting for Payment'
        ]);

        return redirect()->back()->with('success', 'Booking disetujui! Menunggu pembayaran dari customer.');
    }

    public function confirmPayment(int $id)
    {
        $booking = Booking::findOrFail($id);
        $unit = Unit::find($booking->unit_id);

        DB::beginTransaction();
        try {
            // 1. Update Booking
            $booking->update([
                'status' => 'Confirmed',
                'payment_status' => 'Paid'
            ]);

            // 2. Update Unit
            if ($unit) {
                $unit->update(['status' => 'Terisi']);
            }

            DB::commit();
            return redirect()->back()->with('success', 'Pembayaran berhasil diverifikasi! Unit sekarang terisi.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal verifikasi: ' . $e->getMessage());
        }
    }

    public function kelolaPenyewa()
    {
        // Ambil booking yang sudah confirmed/paid (sedang aktif menjadi penyewa)
        $penyewaAktif = Booking::with('unit')
            ->where('status', 'Confirmed')
            ->orderBy('tgl_masuk', 'desc')
            ->get();
            
        return view('admin_penyewa', compact('penyewaAktif'));
    }

    public function laporanKeuangan()
    {
        // Hitung total pemasukan dari booking yang status pembayarannya 'Paid'
        $transaksiSelesai = Booking::with('unit')
            ->where('payment_status', 'Paid')
            ->orderBy('updated_at', 'desc')
            ->get();
            
        $totalPemasukan = $transaksiSelesai->sum('total_harga');
        
        return view('admin_laporan', compact('transaksiSelesai', 'totalPemasukan'));
    }
}
