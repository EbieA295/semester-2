@extends('layouts.dashboard')

@section('title', 'Admin Dashboard')
@section('page_title', 'Ringkasan Statistik')

@section('content')
<div class="row g-4 mb-5">
    <div class="col-md-3">
        <div class="card-stats">
            <div class="stat-icon bg-soft-orange text-orange">
                <i data-lucide="home"></i>
            </div>
            <div class="text-muted small fw-bold mb-1 text-uppercase">Total Unit</div>
            <h3 class="fw-800 mb-0">{{ count($units ?? []) }}</h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card-stats">
            <div class="stat-icon bg-success bg-opacity-10 text-success">
                <i data-lucide="check-circle"></i>
            </div>
            <div class="text-muted small fw-bold mb-1 text-uppercase">Tersedia</div>
            <h3 class="fw-800 mb-0">{{ count(($units ?? collect())->where('status', 'Tersedia')) }}</h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card-stats">
            <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                <i data-lucide="calendar"></i>
            </div>
            <div class="text-muted small fw-bold mb-1 text-uppercase">Booking Menunggu</div>
            <h3 class="fw-800 mb-0">{{ count(($bookings ?? collect())->where('status', 'Pending')) }}</h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card-stats">
            <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                <i data-lucide="trending-up"></i>
            </div>
            <div class="text-muted small fw-bold mb-1 text-uppercase">Okupansi</div>
            <h3 class="fw-800 mb-0">85%</h3>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card border-0 rounded-4 shadow-sm bg-white overflow-hidden mb-4">
            <div class="p-4 border-bottom d-flex justify-content-between align-items-center bg-light bg-opacity-50">
                <h6 class="fw-bold mb-0">Antrean Konfirmasi Booking</h6>
                <span class="badge bg-orange px-3 py-2 rounded-pill">{{ count(($bookings ?? collect())->where('status', 'Pending')) }} Menunggu</span>
            </div>
            <div class="table-responsive">
                <table class="table table-premium mb-0">
                    <thead>
                        <tr>
                            <th>Unit</th>
                            <th>Penyewa</th>
                            <th>Tgl Masuk</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookings ?? [] as $b)
                        <tr>
                            <td class="fw-bold">{{ $b->unit_id }}</td>
                            <td>
                                <div class="fw-bold small">{{ $b->user->name ?? $b->nama_penyewa }}</div>
                                <div class="text-muted extra-small">{{ $b->user->no_hp ?? '-' }}</div>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($b->tgl_masuk)->format('d M Y') }}</td>
                            <td>
                                @if(strtolower($b->status) == 'confirmed')
                                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2">Confirmed</span>
                                @else
                                    <span class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-3 py-2">Pending</span>
                                @endif
                            </td>
                            <td>
                                @if(strtolower($b->status) != 'confirmed')
                                <form action="{{ route('admin.konfirmasiBooking', $b->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-orange btn-sm rounded-pill px-3 fw-bold">Konfirmasi</button>
                                </form>
                                @else
                                <button class="btn btn-light btn-sm rounded-pill px-3 fw-bold" disabled>Selesai</button>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="text-muted small">Belum ada antrean booking saat ini</div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card border-0 rounded-4 shadow-sm bg-white p-4">
            <h6 class="fw-bold mb-4">Status Ketersediaan Unit</h6>
            <div class="d-flex flex-wrap gap-2">
                @foreach($units ?? [] as $unit)
                @php
                    $color = $unit->status == 'Tersedia' ? 'var(--primary-orange)' : '#E5E7EB';
                    $textColor = $unit->status == 'Tersedia' ? 'white' : '#9CA3AF';
                @endphp
                <div class="rounded-3 p-2 text-center shadow-sm" style="background: {{ $color }}; color: {{ $textColor }}; min-width: 50px; font-size: 11px; font-weight: 700;">
                    {{ $unit->id }}
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card border-0 rounded-4 shadow-sm bg-white p-4 mb-4">
            <h6 class="fw-bold mb-4">Aksi Cepat</h6>
            <div class="d-grid gap-3">
                <button class="btn btn-orange py-3 rounded-4 fw-bold">
                    <i data-lucide="plus-circle" class="me-2" style="width: 18px;"></i> Tambah Unit Baru
                </button>
                <button class="btn btn-light py-3 rounded-4 fw-bold">
                    <i data-lucide="file-text" class="me-2" style="width: 18px;"></i> Laporan Keuangan
                </button>
                <button class="btn btn-light py-3 rounded-4 fw-bold">
                    <i data-lucide="users" class="me-2" style="width: 18px;"></i> Manajemen User
                </button>
            </div>
        </div>

        <div class="card border-0 rounded-4 shadow-sm bg-white p-4">
            <h6 class="fw-bold mb-4 small text-muted text-uppercase">Bantuan Admin</h6>
            <div class="bg-soft-orange p-3 rounded-4 mb-3">
                <p class="small mb-0 text-dark">
                    <strong>Butuh bantuan?</strong> Hubungi tim support KostKita jika ada kendala pada sistem dashboard.
                </p>
            </div>
            <a href="#" class="btn btn-outline-orange w-100 rounded-pill fw-bold py-2">Buka Tiket Support</a>
        </div>
    </div>
</div>
@endsection
