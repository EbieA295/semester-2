@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="container mt-5 pt-lg-5">
    <div class="row align-items-center mb-5 pb-lg-5">
        <div class="col-lg-6">
            <span class="badge bg-soft-orange text-orange px-3 py-2 rounded-pill fw-bold mb-3">
                ✨ SOLUSI KOST MAHASISWA NO. 1
            </span>
            <h1 class="display-3 fw-800 mb-4" style="line-height: 1.1; letter-spacing: -2px;">
                Temukan Kost <span class="text-orange">Nyaman</span> <br>di Sekitar Kampus.
            </h1>
            <p class="lead text-muted mb-5 pe-lg-5">
                Cari, cek fasilitas, dan booking kost impianmu dalam hitungan menit. Transparan, aman, dan tanpa biaya tambahan.
            </p>
            <div class="d-flex flex-wrap gap-3">
                <a href="#daftar-kamar" class="btn btn-orange px-5 py-3">
                    <i data-lucide="search" class="me-2" style="width: 20px;"></i> Cari Kamar Sekarang
                </a>
                <div class="d-flex align-items-center gap-3 ms-lg-3">
                    <div class="avatar-group d-flex">
                        <img src="https://i.pravatar.cc/150?u=1" class="rounded-circle border border-4 border-white shadow-sm" width="45">
                        <img src="https://i.pravatar.cc/150?u=2" class="rounded-circle border border-4 border-white shadow-sm" width="45" style="margin-left: -15px;">
                        <img src="https://i.pravatar.cc/150?u=3" class="rounded-circle border border-4 border-white shadow-sm" width="45" style="margin-left: -15px;">
                    </div>
                    <div>
                        <div class="fw-bold small">500+ Mahasiswa</div>
                        <div class="text-muted extra-small" style="font-size: 11px;">Sudah menemukan kost</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mt-5 mt-lg-0">
            <div class="position-relative p-4">
                <div class="position-absolute top-50 start-50 translate-middle w-100 h-100 bg-soft-orange rounded-circle opacity-50" style="filter: blur(80px); z-index: -1;"></div>
                <img src="https://illustrations.popsy.co/amber/working-from-home.svg" class="img-fluid floating-animation" alt="Hero Illustration">
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="row g-4 mb-5 pb-5 mt-lg-5">
        <div class="col-md-4">
            <div class="p-4 rounded-4 bg-white shadow-sm border-0 h-100 feature-card">
                <div class="icon-box bg-soft-orange text-orange mb-3">
                    <i data-lucide="shield-check" size="28"></i>
                </div>
                <h5 class="fw-bold mb-2">Terverifikasi 100%</h5>
                <p class="text-muted small mb-0">Setiap unit kost telah melalui proses verifikasi lapangan oleh tim kami untuk menjamin keaslian data.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-4 rounded-4 bg-white shadow-sm border-0 h-100 feature-card">
                <div class="icon-box bg-soft-orange text-orange mb-3">
                    <i data-lucide="credit-card" size="28"></i>
                </div>
                <h5 class="fw-bold mb-2">Pembayaran Aman</h5>
                <p class="text-muted small mb-0">Sistem pembayaran yang aman dan transparan langsung ke pengelola kost melalui platform kami.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-4 rounded-4 bg-white shadow-sm border-0 h-100 feature-card">
                <div class="icon-box bg-soft-orange text-orange mb-3">
                    <i data-lucide="zap" size="28"></i>
                </div>
                <h5 class="fw-bold mb-2">Booking Instan</h5>
                <p class="text-muted small mb-0">Lupakan ribetnya survey lokasi. Cek detail foto 360°, pilih kamar, dan booking langsung hari ini.</p>
            </div>
        </div>
    </div>

    <!-- Kost Grid Section -->
    <div id="daftar-kamar" class="pt-5 pb-5">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-end mb-5">
            <div>
                <h2 class="fw-800 mb-2">Rekomendasi Kamar Terpopuler</h2>
                <p class="text-muted mb-0">Pilihan kost terbaik berdasarkan rating dan fasilitas mahasiswa.</p>
            </div>
            <a href="#" class="text-orange fw-bold text-decoration-none mt-3 mt-md-0">Lihat Semua <i data-lucide="arrow-right" class="ms-1" style="width: 18px;"></i></a>
        </div>

        <div class="row g-4">
            @forelse($semuaKamar ?? [] as $kamar)
            <div class="col-lg-4 col-md-6">
                <div class="card card-premium h-100 border-0 shadow-sm overflow-hidden bg-white">
                    <div class="position-relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1522770179533-24471fcdba45?auto=format&fit=crop&q=80&w=1000" class="card-img-top" style="height: 260px; object-fit: cover;">
                        <div class="card-img-overlay p-3">
                            <span class="badge {{ $kamar->stok_kamar > 0 ? 'bg-success' : 'bg-danger' }} px-3 py-2 rounded-pill shadow-sm">
                                {{ $kamar->stok_kamar > 0 ? 'Tersedia' : 'Penuh' }}
                            </span>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h5 class="fw-bold mb-1 text-truncate" style="max-width: 200px;">{{ $kamar->nama_kamar }}</h5>
                                <p class="text-muted small mb-0 d-flex align-items-center">
                                    <i data-lucide="map-pin" size="14" class="me-1 text-orange"></i> 5 Menit ke Kampus
                                </p>
                            </div>
                            <div class="text-warning small fw-bold d-flex align-items-center">
                                <i data-lucide="star" fill="currentColor" size="16" class="me-1"></i> 4.9
                            </div>
                        </div>

                        <div class="d-flex gap-3 mb-4">
                            <div class="badge bg-light text-dark fw-medium rounded-pill px-3 py-2 d-flex align-items-center gap-1">
                                <i data-lucide="wind" size="14"></i> AC
                            </div>
                            <div class="badge bg-light text-dark fw-medium rounded-pill px-3 py-2 d-flex align-items-center gap-1">
                                <i data-lucide="wifi" size="14"></i> WiFi
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center pt-3 border-top mt-auto">
                            <div>
                                <span class="fw-800 text-orange h4 mb-0">Rp {{ number_format($kamar->harga_per_bulan / 1000, 0) }}k</span>
                                <span class="text-muted small">/bln</span>
                            </div>
                            <a href="/login" class="btn btn-outline-orange btn-sm rounded-pill px-4">Detail</a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <div class="p-5 bg-white rounded-5 shadow-sm d-inline-block">
                    <i data-lucide="search-x" size="48" class="text-muted mb-3 opacity-25"></i>
                    <p class="text-muted fs-5 mb-0">Belum ada kamar yang terdaftar saat ini.</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div>

<style>
    .floating-animation {
        animation: float 4s ease-in-out infinite;
    }
    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-20px); }
    }

    .icon-box {
        width: 56px;
        height: 56px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 16px;
    }

    .feature-card {
        transition: all 0.3s ease;
    }
    .feature-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.05) !important;
    }

    .card-premium {
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        border-radius: 28px;
    }
    .card-premium:hover {
        transform: scale(1.02);
        box-shadow: 0 25px 50px rgba(0,0,0,0.08) !important;
    }
    .card-premium .card-img-top {
        transition: transform 0.6s ease;
    }
    .card-premium:hover .card-img-top {
        transform: scale(1.1);
    }
</style>
@endsection
