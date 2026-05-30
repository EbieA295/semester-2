@extends('layouts.dashboard')

@section('title', 'Pemilik Dashboard')
@section('page_title', 'Ringkasan Bisnis')

@section('content')
<!-- Header Stats -->
<div class="row g-4 mb-5">
    <div class="col-md-3" data-aos="fade-up">
        <div class="card border-0 rounded-4 shadow-sm p-4 h-100 position-relative overflow-hidden group hover-shadow card-gradient-success">
            <div class="position-absolute top-0 end-0 p-3 opacity-25 transition-all group-hover-scale">
                <i data-lucide="wallet" size="80" class="text-success"></i>
            </div>
            <div class="position-relative z-1">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="bg-white rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 45px; height: 45px;">
                        <i data-lucide="wallet" class="text-success" size="20"></i>
                    </div>
                    <div class="text-muted small fw-bold text-uppercase" style="letter-spacing: 1px;">Total Pendapatan</div>
                </div>
                <h3 class="fw-800 mb-0 text-dark">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3" data-aos="fade-up" data-aos-delay="100">
        <div class="card border-0 rounded-4 shadow-sm p-4 h-100 position-relative overflow-hidden group hover-shadow card-gradient-warning">
            <div class="position-absolute top-0 end-0 p-3 opacity-25 transition-all group-hover-scale">
                <i data-lucide="door-open" size="80" class="text-orange"></i>
            </div>
            <div class="position-relative z-1">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="bg-white rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 45px; height: 45px;">
                        <i data-lucide="door-open" class="text-orange" size="20"></i>
                    </div>
                    <div class="text-muted small fw-bold text-uppercase" style="letter-spacing: 1px;">Kamar Tersedia</div>
                </div>
                <h3 class="fw-800 mb-0 text-dark">{{ $unitTersedia }} <span class="fs-6 text-muted fw-normal">Unit</span></h3>
            </div>
        </div>
    </div>
    <div class="col-md-3" data-aos="fade-up" data-aos-delay="200">
        <div class="card border-0 rounded-4 shadow-sm p-4 h-100 position-relative overflow-hidden group hover-shadow card-gradient-danger">
            <div class="position-absolute top-0 end-0 p-3 opacity-25 transition-all group-hover-scale">
                <i data-lucide="users" size="80" class="text-danger"></i>
            </div>
            <div class="position-relative z-1">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="bg-white rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 45px; height: 45px;">
                        <i data-lucide="users" class="text-danger" size="20"></i>
                    </div>
                    <div class="text-muted small fw-bold text-uppercase" style="letter-spacing: 1px;">Okupansi Terisi</div>
                </div>
                <h3 class="fw-800 mb-0 text-dark">{{ $unitTerisi }} <span class="fs-6 text-muted fw-normal">Unit</span></h3>
            </div>
        </div>
    </div>
    <div class="col-md-3" data-aos="fade-up" data-aos-delay="300">
        <div class="card border-0 rounded-4 shadow-sm p-4 h-100 position-relative overflow-hidden group hover-shadow card-gradient-info">
            <div class="position-absolute top-0 end-0 p-3 opacity-25 transition-all group-hover-scale">
                <i data-lucide="bell" size="80" class="text-primary"></i>
            </div>
            <div class="position-relative z-1">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="bg-white rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 45px; height: 45px;">
                        <i data-lucide="bell" class="text-primary" size="20"></i>
                    </div>
                    <div class="text-muted small fw-bold text-uppercase" style="letter-spacing: 1px;">Konfirmasi Booking</div>
                </div>
                <h3 class="fw-800 mb-0 text-dark">{{ $menungguKonfirmasi ?? 0 }} <span class="fs-6 text-muted fw-normal">Antrean</span></h3>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card border-0 rounded-4 shadow-sm bg-white overflow-hidden mb-4" data-aos="fade-right">
            <div class="p-4 border-bottom d-flex justify-content-between align-items-center bg-light bg-opacity-50">
                <h5 class="fw-bold mb-0 text-dark d-flex align-items-center gap-2">
                    <i data-lucide="activity" class="text-orange"></i> Aktivitas Booking Terbaru
                </h5>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Penyewa</th>
                            <th>Unit</th>
                            <th>Tanggal</th>
                            <th>Total Pembayaran</th>
                            <th class="text-end pe-4">Status</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        @forelse($bookingTerbaru as $b)
                        <tr>
                            <td class="ps-4">
                                <div class="fw-bold text-dark text-capitalize">{{ $b->nama_penyewa }}</div>
                                <div class="extra-small text-muted d-flex align-items-center gap-1"><i data-lucide="phone" size="10"></i> {{ $b->no_hp }}</div>
                            </td>
                            <td><span class="badge bg-light text-dark border shadow-sm">#{{ $b->unit_id }}</span></td>
                            <td>
                                <div class="small fw-medium">{{ $b->created_at->format('d M Y') }}</div>
                            </td>
                            <td class="fw-bold text-orange">Rp {{ number_format($b->total_harga, 0, ',', '.') }}</td>
                            <td class="text-end pe-4">
                                @if($b->status == 'Confirmed')
                                    <span class="badge bg-success rounded-pill px-3 shadow-sm"><i data-lucide="check" size="12" class="me-1"></i>Lunas</span>
                                @elseif($b->status == 'Pending')
                                    <span class="badge bg-warning text-dark rounded-pill px-3 shadow-sm">Menunggu</span>
                                @else
                                    <span class="badge bg-secondary rounded-pill px-3 shadow-sm">{{ $b->status }}</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i data-lucide="inbox" size="48" class="opacity-25 mb-3"></i>
                                <div>Belum ada aktivitas booking.</div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card border-0 rounded-4 shadow-sm bg-white overflow-hidden" data-aos="fade-up">
            <div class="p-4 border-bottom d-flex justify-content-between align-items-center bg-light bg-opacity-50">
                <h5 class="fw-bold mb-0 text-dark d-flex align-items-center gap-2">
                    <i data-lucide="grid" class="text-orange"></i> Status Unit Terkini
                </h5>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Unit</th>
                            <th>Tipe & Lokasi</th>
                            <th>Harga/Bln</th>
                            <th class="text-end pe-4">Status</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        @forelse($semuaUnit as $unit)
                        <tr>
                            <td class="ps-4 fw-bold text-dark fs-5">{{ $unit->id }}</td>
                            <td>
                                <div class="fw-bold text-dark">{{ $unit->tipe }}</div>
                                <div class="extra-small text-muted d-flex align-items-center gap-1"><i data-lucide="map-pin" size="10"></i> {{ $unit->lokasi }}</div>
                            </td>
                            <td class="fw-bold text-orange">Rp {{ number_format($unit->harga, 0, ',', '.') }}</td>
                            <td class="text-end pe-4">
                                @php
                                    $bgClass = $unit->status == 'Tersedia' ? 'bg-success' : ($unit->status == 'Terisi' ? 'bg-danger' : 'bg-warning text-dark');
                                @endphp
                                <span class="badge {{ $bgClass }} rounded-pill px-3 py-1 shadow-sm">
                                    {{ $unit->status }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">Belum ada unit yang terdaftar.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card border-0 rounded-4 shadow-sm bg-white p-4 mb-4" data-aos="fade-left">
            <h5 class="fw-bold mb-4 text-dark d-flex align-items-center gap-2">
                <i data-lucide="bar-chart-2" class="text-orange"></i> Analisis Cepat
            </h5>
            <div class="bg-soft-orange p-4 rounded-4 mb-3 text-center transition-all hover-shadow">
                <i data-lucide="trending-up" class="text-orange mb-2" size="32"></i>
                <h4 class="fw-800 mb-1">+12%</h4>
                <p class="small text-muted mb-0">Kenaikan pendapatan bulan ini</p>
            </div>
            <div class="bg-light p-4 rounded-4 mb-4 text-center transition-all hover-shadow">
                <i data-lucide="users" class="text-primary mb-2" size="32"></i>
                <h4 class="fw-800 mb-1">90%</h4>
                <p class="small text-muted mb-0">Tingkat Retensi Penyewa</p>
            </div>
            <a href="{{ route('pemilik.laporan.cetak') }}" target="_blank" class="btn btn-orange w-100 py-3 rounded-4 fw-bold shadow-sm d-flex justify-content-center align-items-center gap-2 transition-all hover-shadow text-decoration-none">
                <i data-lucide="download" size="20"></i> UNDUH LAPORAN PDF
            </a>
        </div>

        <div class="card border-0 rounded-4 shadow-sm bg-white p-4 overflow-hidden position-relative" data-aos="fade-up">
            <div class="position-absolute top-0 end-0 p-3 opacity-10" style="pointer-events: none;">
                <i data-lucide="map" size="100"></i>
            </div>
            <h5 class="fw-bold mb-4 text-dark d-flex align-items-center gap-2 position-relative z-1">
                <i data-lucide="map-pin" class="text-orange"></i> Denah Cepat
            </h5>
            <div class="d-flex flex-wrap gap-2 position-relative z-1">
                @foreach($semuaUnit ?? [] as $unit)
                @php
                    $color = $unit->status == 'Tersedia' ? 'var(--primary-orange)' : ($unit->status == 'Terisi' ? '#EF4444' : '#F59E0B');
                    $shadowColor = $unit->status == 'Tersedia' ? 'rgba(255, 107, 0, 0.4)' : ($unit->status == 'Terisi' ? 'rgba(239, 68, 68, 0.4)' : 'rgba(245, 158, 11, 0.4)');
                @endphp
                <div class="rounded-3 p-2 text-center text-white transition-all hover-scale" style="background: {{ $color }}; box-shadow: 0 4px 10px {{ $shadowColor }}; min-width: 55px; font-size: 12px; font-weight: 800; cursor: pointer;" title="{{ $unit->id }} - {{ $unit->status }}">
                    {{ $unit->id }}
                </div>
                @endforeach
            </div>
            
            <div class="mt-4 pt-3 border-top position-relative z-1">
                <div class="d-flex justify-content-between small text-muted">
                    <div class="d-flex align-items-center gap-1"><span class="rounded-circle d-inline-block" style="width:10px;height:10px;background:var(--primary-orange);"></span> Tersedia</div>
                    <div class="d-flex align-items-center gap-1"><span class="rounded-circle bg-danger d-inline-block" style="width:10px;height:10px;"></span> Terisi</div>
                    <div class="d-flex align-items-center gap-1"><span class="rounded-circle bg-warning d-inline-block" style="width:10px;height:10px;"></span> Dipesan</div>
                </div>
            </div>
        </div>

    </div>
</div>

<style>
    .hover-shadow { transition: all 0.3s ease; }
    .hover-shadow:hover { box-shadow: 0 15px 30px rgba(0,0,0,0.08) !important; transform: translateY(-3px); }
    .group-hover-scale { transition: transform 0.5s ease; }
    .group:hover .group-hover-scale { transform: scale(1.2) rotate(-5deg); }
    .hover-scale { transition: transform 0.2s; }
    .hover-scale:hover { transform: scale(1.15); z-index: 10; position: relative; }
    
    .table-hover tbody tr { transition: background-color 0.2s; }
    .table-hover tbody tr:hover { background-color: rgba(0,0,0,0.02); }
</style>
@endsection