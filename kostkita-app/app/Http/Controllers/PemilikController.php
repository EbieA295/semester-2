<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unit;
use App\Models\Booking;
use Carbon\Carbon;

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

    public function laporanKeuangan(Request $request)
    {
        // Filter bulan dan tahun
        $bulan = $request->input('bulan', Carbon::now()->month);
        $tahun = $request->input('tahun', Carbon::now()->year);
        $filterMode = $request->input('mode', 'bulanan');

        // Query dasar: semua transaksi yang sudah Paid
        $queryBase = Booking::with('unit')->where('payment_status', 'Paid');

        if ($filterMode === 'bulanan') {
            $queryBase->whereMonth('updated_at', $bulan)->whereYear('updated_at', $tahun);
        } elseif ($filterMode === 'tahunan') {
            $queryBase->whereYear('updated_at', $tahun);
        }

        $transaksiSelesai = $queryBase->orderBy('updated_at', 'desc')->get();
        $totalPemasukan = $transaksiSelesai->sum('total_harga');

        // Statistik total keseluruhan
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

        // Unit tipe occupancy
        $totalUnits = Unit::count();
        $unitTerisi = Unit::where('status', 'Terisi')->count();
        $occupancyRate = $totalUnits > 0 ? round(($unitTerisi / $totalUnits) * 100) : 0;

        // Rata-rata pemasukan per bulan
        $avgPerMonth = count($chartData) > 0 ? collect($chartData)->avg('total') : 0;

        return view('pemilik.laporan', compact(
            'transaksiSelesai',
            'totalPemasukan',
            'totalPemasukanAll',
            'totalTransaksiAll',
            'totalPending',
            'chartData',
            'pemasukanPerTipe',
            'avgPerMonth',
            'occupancyRate',
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
