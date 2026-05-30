<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unit;
use App\Models\Booking;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreUnitRequest;
use App\Http\Requests\UpdateUnitRequest;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

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
        
        // Auto-enforce price based on room type
        if ($validated['tipe'] === 'Hemat') {
            $validated['harga'] = 500000;
        } elseif ($validated['tipe'] === 'Standar') {
            $validated['harga'] = 800000;
        } elseif ($validated['tipe'] === 'Premium') {
            $validated['harga'] = 1200000;
        }

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

        // Auto-enforce price based on room type
        if ($validated['tipe'] === 'Hemat') {
            $validated['harga'] = 500000;
        } elseif ($validated['tipe'] === 'Standar') {
            $validated['harga'] = 800000;
        } elseif ($validated['tipe'] === 'Premium') {
            $validated['harga'] = 1200000;
        }

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

    public function laporanKeuangan(Request $request)
    {
        // Filter bulan dan tahun
        $bulan = $request->input('bulan', Carbon::now()->month);
        $tahun = $request->input('tahun', Carbon::now()->year);
        $filterMode = $request->input('mode', 'bulanan'); // bulanan / tahunan / semua

        // Query dasar: semua transaksi yang sudah Paid
        $queryBase = Booking::with('unit')->where('payment_status', 'Paid');

        if ($filterMode === 'bulanan') {
            $queryBase->whereMonth('updated_at', $bulan)->whereYear('updated_at', $tahun);
        } elseif ($filterMode === 'tahunan') {
            $queryBase->whereYear('updated_at', $tahun);
        }
        // mode 'semua' = tidak ada filter

        $transaksiSelesai = $queryBase->orderBy('updated_at', 'desc')->get();
        $totalPemasukan = $transaksiSelesai->sum('total_harga');

        // Statistik total keseluruhan (tanpa filter)
        $totalPemasukanAll = Booking::where('payment_status', 'Paid')->sum('total_harga');
        $totalTransaksiAll = Booking::where('payment_status', 'Paid')->count();
        $totalPending = Booking::where('status', 'Pending')->orWhere('status', 'Waiting for Payment')->count();

        // Data chart bulanan (12 bulan terakhir)
        $chartData = [];
        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthlyTotal = Booking::where('payment_status', 'Paid')
                ->whereMonth('updated_at', $date->month)
                ->whereYear('updated_at', $date->year)
                ->sum('total_harga');
            $monthlyCount = Booking::where('payment_status', 'Paid')
                ->whereMonth('updated_at', $date->month)
                ->whereYear('updated_at', $date->year)
                ->count();
            $chartData[] = [
                'label' => $date->translatedFormat('M Y'),
                'total' => (float)$monthlyTotal,
                'count' => $monthlyCount,
            ];
        }

        // Pemasukan per tipe kamar
        $pemasukanPerTipe = Booking::with('unit')
            ->where('payment_status', 'Paid')
            ->get()
            ->groupBy(function ($b) {
                return $b->unit ? $b->unit->tipe : 'Lainnya';
            })
            ->map(function ($group, $tipe) {
                return [
                    'tipe' => $tipe,
                    'total' => $group->sum('total_harga'),
                    'count' => $group->count(),
                ];
            })->values();

        // Top unit paling menghasilkan
        $topUnits = Booking::where('payment_status', 'Paid')
            ->selectRaw('unit_id, SUM(total_harga) as total_income, COUNT(*) as total_transaksi')
            ->groupBy('unit_id')
            ->orderByDesc('total_income')
            ->take(5)
            ->get();

        // Rata-rata pemasukan per bulan
        $avgPerMonth = count($chartData) > 0
            ? collect($chartData)->avg('total')
            : 0;

        return view('admin_laporan', compact(
            'transaksiSelesai',
            'totalPemasukan',
            'totalPemasukanAll',
            'totalTransaksiAll',
            'totalPending',
            'chartData',
            'pemasukanPerTipe',
            'topUnits',
            'avgPerMonth',
            'bulan',
            'tahun',
            'filterMode'
        ));
    }

    public function exportLaporan(Request $request)
    {
        $bulan = $request->input('bulan', Carbon::now()->month);
        $tahun = $request->input('tahun', Carbon::now()->year);
        $filterMode = $request->input('mode', 'bulanan');

        $queryBase = Booking::with('unit')->where('payment_status', 'Paid');

        if ($filterMode === 'bulanan') {
            $queryBase->whereMonth('updated_at', $bulan)->whereYear('updated_at', $tahun);
        } elseif ($filterMode === 'tahunan') {
            $queryBase->whereYear('updated_at', $tahun);
        }

        $transaksiSelesai = $queryBase->orderBy('updated_at', 'desc')->get();
        $totalPemasukan = $transaksiSelesai->sum('total_harga');

        // Determine period name for the header
        if ($filterMode === 'bulanan') {
            $periodName = Carbon::create($tahun, $bulan)->translatedFormat('F Y');
        } elseif ($filterMode === 'tahunan') {
            $periodName = "Tahun $tahun";
        } else {
            $periodName = 'Semua Periode';
        }

        return view('admin_laporan_cetak', compact(
            'transaksiSelesai',
            'totalPemasukan',
            'periodName',
            'filterMode'
        ));
    }
}
