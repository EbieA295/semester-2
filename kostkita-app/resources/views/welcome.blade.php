@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row align-items-center py-5 mb-5">
        <div class="col-lg-6 mb-4 mb-lg-0">
            <span class="badge rounded-pill px-3 py-2 mb-3" style="background: var(--soft-orange); color: var(--primary-orange); font-weight: 700; letter-spacing: 0.5px;">
                🚀 PLATFORM KOST NO. 1 DI KAMPUS
            </span>
            <h1 class="display-3 fw-bold mb-3" style="letter-spacing: -2px; line-height: 1.1;">
                Cari Kost Nyaman <br><span style="color: var(--primary-orange);">Tanpa Ribet.</span>
            </h1>
            <p class="lead text-muted mb-4 pe-lg-5">
                Bukan sekadar tempat tinggal, tapi rumah kedua untuk mendukung produktivitas belajarmu. Booking cepat dan transparan.
            </p>
            <div class="d-flex align-items-center gap-3">
                <a href="#daftar-kamar" class="btn btn-orange px-4 py-3 shadow-lg rounded-pill">
                    <i data-lucide="search" class="me-2" style="width: 20px;"></i> Cari Kamar Sekarang
                </a>
                <div class="d-flex align-items-center gap-2 d-none d-sm-flex">
                    <div class="avatar-group d-flex">
                        <img src="https://i.pravatar.cc/150?u=1" class="rounded-circle border border-white shadow-sm" width="35">
                        <img src="https://i.pravatar.cc/150?u=2" class="rounded-circle border border-white shadow-sm" width="35" style="margin-left: -10px;">
                    </div>
                    <span class="small text-muted fw-bold">500+ Mahasiswa</span>
                </div>
            </div>
        </div>
        <div class="col-lg-6 text-center d-none d-lg-block">
            <div class="position-relative">
                <div class="position-absolute top-50 start-50 translate-middle w-75 h-75 rounded-circle" style="background: var(--primary-orange); filter: blur(100px); opacity: 0.15; z-index: -1;"></div>
                <img src="https://illustrations.popsy.co/amber/home-office.svg" class="img-fluid floating-animation" style="max-height: 420px;">
            </div>
        </div>
    </div>

    <div class="row g-4 mb-5 pb-5">
        <div class="col-md-4">
            <div class="p-4 rounded-4 bg-white shadow-sm border-0 h-100 card-hover">
                <div class="mb-3 text-orange"><i data-lucide="shield-check" size="32"></i></div>
                <h6 class="fw-bold">Terverifikasi</h6>
                <p class="text-muted small mb-0">Semua kost sudah dicek langsung untuk keamananmu.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-4 rounded-4 bg-white shadow-sm border-0 h-100 card-hover">
                <div class="mb-3 text-orange"><i data-lucide="zap" size="32"></i></div>
                <h6 class="fw-bold">Proses Kilat</h6>
                <p class="text-muted small mb-0">Booking dan konfirmasi pembayaran dalam hitungan menit.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-4 rounded-4 bg-white shadow-sm border-0 h-100 card-hover">
                <div class="mb-3 text-orange"><i data-lucide="map" size="32"></i></div>
                <h6 class="fw-bold">Lokasi Strategis</h6>
                <p class="text-muted small mb-0">Pilihan kost terdekat dari gerbang utama kampus.</p>
            </div>
        </div>
    </div>

    <div id="daftar-kamar" class="pt-5 mt-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Rekomendasi Kamar</h2>
            <div style="width: 60px; height: 5px; background: var(--primary-orange); margin: 12px auto; border-radius: 10px;"></div>
        </div>

        <div class="row g-4">
            @forelse($semuaKamar ?? [] as $kamar)
            <div class="col-md-4">
                <div class="card card-modern h-100 bg-white border-0 shadow-sm overflow-hidden p-2" style="border-radius: 24px;">
                    <div class="position-relative">
                        <img src="https://images.unsplash.com/photo-1522770179533-24471fcdba45?auto=format&fit=crop&q=80&w=1000" class="card-img-top rounded-4" style="height: 240px; object-fit: cover;">
                        <div class="position-absolute top-0 end-0 m-3">
                            <span class="badge {{ $kamar->stok_kamar > 0 ? 'bg-success' : 'bg-danger' }} py-2 px-3 shadow-sm rounded-3">
                                {{ $kamar->stok_kamar > 0 ? 'Tersedia' : 'Penuh' }}
                            </span>
                        </div>
                        <div class="position-absolute bottom-0 start-0 m-3">
                            <div class="bg-white px-3 py-2 rounded-3 shadow-sm">
                                <span class="fw-bold text-orange">Rp {{ number_format($kamar->harga_per_bulan / 1000, 0) }}k</span><span class="small text-muted">/bln</span>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-4 pt-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="fw-bold mb-0 text-truncate" style="max-width: 80%;">{{ $kamar->nama_kamar }}</h5>
                            <div class="text-warning small"><i data-lucide="star" fill="currentColor" size="14"></i> 4.8</div>
                        </div>
                        <p class="text-muted small mb-4"><i data-lucide="map-pin" size="14" class="me-1 text-orange"></i> 5 Menit ke Fakultas Teknik</p>

                        <div class="d-flex gap-3 mb-4">
                            <div class="small text-muted d-flex align-items-center gap-1"><i data-lucide="wind" size="14" class="text-orange"></i> AC</div>
                            <div class="small text-muted d-flex align-items-center gap-1"><i data-lucide="wifi" size="14" class="text-orange"></i> WiFi</div>
                            <div class="small text-muted d-flex align-items-center gap-1"><i data-lucide="bath" size="14" class="text-orange"></i> KM</div>
                        </div>

                        <button class="btn btn-orange w-100 py-2 fw-bold rounded-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalBooking{{ $kamar->id }}">
                            Booking Sekarang
                        </button>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <i data-lucide="inbox" size="48" class="text-muted mb-3 opacity-25"></i>
                <p class="text-muted fs-5 italic">Belum ada kamar yang tersedia.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

<style>
    /* Update Animasi dan Hover */
    .floating-animation {
        animation: floating 4s ease-in-out infinite;
    }
    @keyframes floating {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
        100% { transform: translateY(0px); }
    }
    .card-hover {
        transition: all 0.3s ease;
    }
    .card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(255, 107, 53, 0.1) !important;
    }
    .card-modern {
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .card-modern:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.08) !important;
    }
    .text-orange { color: var(--primary-orange); }
</style>
@endsection
