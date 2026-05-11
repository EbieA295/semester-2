@extends('layouts.dashboard')

@section('title', 'Pemilik Dashboard')
@section('page_title', 'Ringkasan Bisnis')

@section('content')
<div class="row g-4 mb-5">
    <div class="col-md-4" data-aos="fade-up">
        <div class="card-stats">
            <div class="stat-icon" style="background: #ECFDF5; color: #10B981;">
                <i data-lucide="wallet"></i>
            </div>
            <div class="text-muted extra-small fw-bold text-uppercase">Total Pendapatan</div>
            <h3 class="fw-800 mb-0">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
        </div>
    </div>
    <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
        <div class="card-stats">
            <div class="stat-icon" style="background: #FFF4F0; color: #F47B20;">
                <i data-lucide="door-open"></i>
            </div>
            <div class="text-muted extra-small fw-bold text-uppercase">Kamar Tersedia</div>
            <h3 class="fw-800 mb-0">{{ $unitTersedia }} Unit</h3>
        </div>
    </div>
    <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
        <div class="card-stats">
            <div class="stat-icon" style="background: #FEF2F2; color: #EF4444;">
                <i data-lucide="users"></i>
            </div>
            <div class="text-muted extra-small fw-bold text-uppercase">Okupansi Terisi</div>
            <h3 class="fw-800 mb-0">{{ $unitTerisi }} Unit</h3>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card border-0 rounded-4 shadow-sm bg-white overflow-hidden" data-aos="fade-right">
            <div class="p-4 border-bottom d-flex justify-content-between align-items-center">
                <h6 class="fw-bold mb-0">Aktivitas Booking Terbaru</h6>
                <a href="#" class="text-orange small text-decoration-none fw-bold">Lihat Semua</a>
            </div>
            <div class="table-responsive">
                <table class="table table-premium mb-0">
                    <thead>
                        <tr>
                            <th>Penyewa</th>
                            <th>Unit</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookingTerbaru as $b)
                        <tr>
                            <td>
                                <div class="fw-bold text-capitalize">{{ $b->nama_penyewa }}</div>
                                <div class="extra-small text-muted">{{ $b->no_hp }}</div>
                            </td>
                            <td><span class="badge bg-light text-dark border">{{ $b->unit_id }}</span></td>
                            <td>{{ $b->created_at->format('d M Y') }}</td>
                            <td>
                                @if($b->status == 'Confirmed')
                                    <span class="badge bg-success rounded-pill px-3">Lunas</span>
                                @else
                                    <span class="badge bg-warning rounded-pill px-3">{{ $b->status }}</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">Belum ada aktivitas booking.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card border-0 rounded-4 shadow-sm bg-white p-4" data-aos="fade-left">
            <h6 class="fw-bold mb-4">Laporan Cepat</h6>
            <div class="bg-soft-orange p-4 rounded-4 mb-3 text-center">
                <i data-lucide="trending-up" class="text-orange mb-2" size="32"></i>
                <h5 class="fw-800 mb-1">+12%</h5>
                <p class="extra-small text-muted mb-0">Kenaikan pendapatan bulan ini</p>
            </div>
            <button class="btn btn-orange w-100 py-3 rounded-4 fw-bold shadow-sm">UNDUH LAPORAN PDF</button>
        </div>
    </div>
</div>
@endsection