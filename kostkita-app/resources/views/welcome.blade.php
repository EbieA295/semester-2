@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="position-relative overflow-hidden" style="background: linear-gradient(135deg, var(--bg-light) 0%, var(--soft-orange) 100%); padding: 120px 0 80px 0;">
    <!-- Abstract Shapes -->
    <div class="position-absolute rounded-circle" style="width: 400px; height: 400px; background: radial-gradient(circle, rgba(255,107,0,0.15) 0%, rgba(255,107,0,0) 70%); top: -100px; right: -100px;"></div>
    <div class="position-absolute rounded-circle animate-float" style="width: 300px; height: 300px; background: radial-gradient(circle, rgba(255,145,56,0.1) 0%, rgba(255,145,56,0) 70%); bottom: 50px; left: -50px;"></div>
    
    <div class="container position-relative z-1">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0 text-center text-lg-start">
                <span class="badge bg-white text-orange px-3 py-2 rounded-pill shadow-sm mb-4 fw-bold border" style="font-size: 14px;">✨ #1 Kost App di Kampus</span>
                <h1 class="display-3 fw-800 mb-4 text-dark" style="line-height: 1.2;">
                    Cari Kost <br>
                    <span class="text-transparent" style="background: linear-gradient(135deg, var(--primary-orange), var(--accent-orange)); -webkit-background-clip: text; color: transparent;">Super Nyaman</span> <br>
                    Tanpa Ribet.
                </h1>
                <p class="lead text-muted mb-5 pe-lg-5">Platform penyewaan kost modern dengan sistem booking instan, pembayaran aman, dan pilihan kamar terbaik untukmu.</p>
                <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center justify-content-lg-start">
                    <a href="#daftar-kamar" class="btn btn-orange px-5 py-3 rounded-pill" style="font-size: 1.1rem;">Cari Kamar Sekarang</a>
                    <a href="/register" class="btn btn-white px-5 py-3 rounded-pill fw-bold border shadow-sm" style="font-size: 1.1rem;">Daftar Akun</a>
                </div>
                
                <div class="d-flex align-items-center gap-4 mt-5 justify-content-center justify-content-lg-start">
                    <div class="d-flex align-items-center gap-2">
                        <div class="fs-4 fw-800 text-dark">5k+</div>
                        <div class="small text-muted lh-sm">Kamar<br>Tersedia</div>
                    </div>
                    <div style="width: 1px; height: 40px; background: var(--border-light);"></div>
                    <div class="d-flex align-items-center gap-2">
                        <div class="fs-4 fw-800 text-dark">10k+</div>
                        <div class="small text-muted lh-sm">Penyewa<br>Aktif</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 position-relative">
                <div class="position-absolute w-100 h-100 bg-orange rounded-5" style="transform: rotate(3deg); opacity: 0.1; top: 10px; left: 10px; z-index: 0;"></div>
                <img src="{{ asset('images/rooms/hero.png') }}" class="img-fluid rounded-5 shadow-lg position-relative z-1 animate-float" style="border: 8px solid white;" alt="Hero Image">
                
                <!-- Floating Card -->
                <div class="position-absolute bg-white rounded-4 shadow-lg p-3 z-2 glass-effect animate-float" style="bottom: -20px; left: -30px; animation-delay: 1s;">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-success rounded-circle d-flex align-items-center justify-content-center text-white" style="width: 40px; height: 40px;">
                            <i data-lucide="check" size="20"></i>
                        </div>
                        <div>
                            <div class="fw-bold small text-dark">Booking Berhasil!</div>
                            <div class="extra-small text-muted">Ahmad baru saja booking.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Search Filter Section -->
<div class="container position-relative z-2" style="margin-top: -50px;">
    <div class="bg-white rounded-5 shadow-lg p-4 p-md-5 border" style="box-shadow: 0 20px 40px rgba(0,0,0,0.05) !important;">
        <form action="/" method="GET" class="row g-4 align-items-end">
            <div class="col-md-4">
                <label class="small fw-bold text-muted mb-2 text-uppercase letter-spacing-1">Cari Lokasi</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-0 rounded-start-4 ps-4"><i data-lucide="map-pin" size="20" class="text-orange"></i></span>
                    <input type="text" name="lokasi" class="form-control bg-light border-0 py-3 rounded-end-4" placeholder="Contoh: Dekat UNILA" value="{{ request('lokasi') }}">
                </div>
            </div>
            <div class="col-md-3">
                <label class="small fw-bold text-muted mb-2 text-uppercase letter-spacing-1">Tipe Kamar</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-0 rounded-start-4 ps-4"><i data-lucide="home" size="20" class="text-muted"></i></span>
                    <select name="tipe" class="form-select bg-light border-0 py-3 rounded-end-4">
                        <option value="Semua Tipe">Semua Tipe</option>
                        <option value="Hemat" {{ request('tipe') == 'Hemat' ? 'selected' : '' }}>Hemat</option>
                        <option value="Standar" {{ request('tipe') == 'Standar' ? 'selected' : '' }}>Standar</option>
                        <option value="Premium" {{ request('tipe') == 'Premium' ? 'selected' : '' }}>Premium</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <label class="small fw-bold text-muted mb-2 text-uppercase letter-spacing-1">Harga Maks</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-0 rounded-start-4 ps-4 fw-bold text-muted">Rp</span>
                    <input type="number" name="harga_max" class="form-control bg-light border-0 py-3 rounded-end-4" placeholder="2.000.000" value="{{ request('harga_max') }}">
                </div>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-orange w-100 py-3 rounded-4 fw-bold shadow-sm d-flex justify-content-center align-items-center gap-2">
                    <i data-lucide="search" size="20"></i> CARI
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Room List Section -->
<div id="daftar-kamar" class="py-5 container mt-5">
    <div class="text-center mb-5">
        <h6 class="text-orange fw-bold text-uppercase mb-2 letter-spacing-1">Pilihan Terbaik</h6>
        <h2 class="fw-800 display-6 mb-3">Rekomendasi Kost Untukmu</h2>
        <p class="text-muted mx-auto" style="max-width: 600px;">Temukan berbagai pilihan kamar yang sesuai dengan kebutuhan dan budgetmu. Tersedia opsi harian, bulanan, dan tahunan.</p>
    </div>

    <div class="row g-4">
        @forelse($semuaKamar ?? [] as $kamar)
        <div class="col-lg-4 col-md-6">
            <div class="card border-0 rounded-4 shadow-sm h-100 card-premium bg-white overflow-hidden">
                <div class="position-relative overflow-hidden group">
                    <img src="{{ $kamar->image ? asset('storage/'.$kamar->image) : ($kamar->tipe == 'Premium' ? asset('images/rooms/premium.png') : asset('images/rooms/standard.png')) }}" class="card-img-top" style="height: 220px; object-fit: cover; transition: transform 0.5s;">
                    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(to bottom, rgba(0,0,0,0.1), rgba(0,0,0,0.5)); opacity: 0; transition: opacity 0.3s;"></div>
                    
                    <span class="badge bg-white text-dark position-absolute top-0 start-0 m-3 px-3 py-2 rounded-pill shadow-sm fw-bold">
                        <i data-lucide="star" size="14" class="text-warning fill-warning me-1"></i> 4.8
                    </span>

                    @auth
                    <form action="{{ route('customer.wishlist.toggle', $kamar->id) }}" method="POST" class="position-absolute top-0 end-0 m-3">
                        @csrf
                        @php $isWishlisted = Auth::user()->wishlists()->where('unit_id', $kamar->id)->exists(); @endphp
                        <button type="submit" class="btn {{ $isWishlisted ? 'btn-orange' : 'btn-white text-muted' }} rounded-circle p-2 shadow-sm border-0 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; transition: all 0.2s;">
                            <i data-lucide="heart" size="18" style="{{ $isWishlisted ? 'fill: white' : '' }}"></i>
                        </button>
                    </form>
                    @endauth
                </div>
                <div class="card-body p-4 d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <h5 class="fw-bold mb-0 text-truncate">{{ $kamar->id }} - {{ $kamar->tipe }}</h5>
                    </div>
                    <p class="text-muted small mb-3 d-flex align-items-center gap-1">
                        <i data-lucide="map-pin" size="14" class="text-orange"></i> {{ $kamar->lokasi }}
                    </p>
                    
                    <div class="d-flex gap-2 mb-4 flex-wrap">
                        @if($kamar->tipe == 'Premium')
                            <span class="badge bg-light text-dark fw-medium rounded-pill px-2 py-1 border"><i data-lucide="wind" size="12" class="me-1"></i> AC</span>
                            <span class="badge bg-light text-dark fw-medium rounded-pill px-2 py-1 border"><i data-lucide="wifi" size="12" class="me-1"></i> WiFi</span>
                        @endif
                        <span class="badge bg-light text-dark fw-medium rounded-pill px-2 py-1 border"><i data-lucide="bath" size="12" class="me-1"></i> K.Mandi</span>
                        <span class="badge bg-light text-dark fw-medium rounded-pill px-2 py-1 border"><i data-lucide="bed-single" size="12" class="me-1"></i> Kasur</span>
                        <span class="badge bg-light text-dark fw-medium rounded-pill px-2 py-1 border"><i data-lucide="layout-grid" size="12" class="me-1"></i> Lemari</span>
                    </div>

                    <div class="d-flex justify-content-between align-items-end pt-3 border-top mt-auto">
                        <div>
                            <div class="text-muted extra-small text-uppercase fw-bold mb-1">Harga mulai</div>
                            <span class="fw-800 text-orange h5 mb-0">Rp {{ number_format($kamar->harga, 0, ',', '.') }}</span>
                            <span class="text-muted small">/bln</span>
                        </div>
                        <button type="button" class="btn btn-outline-orange rounded-pill px-4 fw-bold" data-bs-toggle="modal" data-bs-target="#modalDetail{{ $kamar->id }}">Detail</button>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <div class="p-5 bg-white rounded-5 shadow-sm border d-inline-block">
                <i data-lucide="search-x" size="48" class="text-muted mb-3 opacity-50"></i>
                <h4 class="fw-bold">Kamar tidak ditemukan</h4>
                <p class="text-muted mb-0">Coba ubah filter pencarian Anda untuk melihat lebih banyak hasil.</p>
            </div>
        </div>
        @endforelse
    </div>
</div>

<!-- Modals Detail -->
@foreach($semuaKamar ?? [] as $kamar)
<div class="modal fade" id="modalDetail{{ $kamar->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 rounded-4 shadow-lg overflow-hidden">
            <div class="row g-0">
                <div class="col-md-6">
                    <img src="{{ $kamar->image ? asset('storage/'.$kamar->image) : ($kamar->tipe == 'Premium' ? asset('images/rooms/premium.png') : asset('images/rooms/standard.png')) }}" class="img-fluid h-100 w-100" style="object-fit: cover; min-height: 300px;">
                </div>
                <div class="col-md-6 p-4 p-md-5 position-relative">
                    <button type="button" class="btn-close position-absolute top-0 end-0 m-4 bg-light rounded-circle p-2" data-bs-dismiss="modal"></button>
                    
                    <span class="badge bg-soft-orange text-orange px-3 py-1 rounded-pill mb-3 fw-bold">{{ $kamar->tipe }}</span>
                    <h3 class="fw-800 mb-2">Unit {{ $kamar->id }}</h3>
                    <p class="text-muted mb-4 d-flex align-items-center gap-1"><i data-lucide="map-pin" size="16" class="text-orange"></i> {{ $kamar->lokasi }}</p>
                    
                    <div class="mb-4">
                        <h6 class="fw-bold small text-uppercase text-muted mb-3">Fasilitas</h6>
                        <div class="d-flex flex-wrap gap-2">
                            @if($kamar->tipe == 'Premium')
                                <div class="border rounded-3 px-3 py-2 text-center flex-grow-1"><i data-lucide="wind" size="20" class="mb-1 text-muted"></i><div class="extra-small fw-bold">AC</div></div>
                                <div class="border rounded-3 px-3 py-2 text-center flex-grow-1"><i data-lucide="wifi" size="20" class="mb-1 text-muted"></i><div class="extra-small fw-bold">WiFi</div></div>
                                <div class="border rounded-3 px-3 py-2 text-center flex-grow-1"><i data-lucide="bed-double" size="20" class="mb-1 text-muted"></i><div class="extra-small fw-bold">Spring Bed</div></div>
                                <div class="border rounded-3 px-3 py-2 text-center flex-grow-1"><i data-lucide="bath" size="20" class="mb-1 text-muted"></i><div class="extra-small fw-bold">KM. Dalam</div></div>
                                <div class="border rounded-3 px-3 py-2 text-center flex-grow-1"><i data-lucide="layout-grid" size="20" class="mb-1 text-muted"></i><div class="extra-small fw-bold">Lemari</div></div>
                            @elseif($kamar->tipe == 'Standar')
                                <div class="border rounded-3 px-3 py-2 text-center flex-grow-1"><i data-lucide="bed-single" size="20" class="mb-1 text-muted"></i><div class="extra-small fw-bold">Kasur</div></div>
                                <div class="border rounded-3 px-3 py-2 text-center flex-grow-1"><i data-lucide="bath" size="20" class="mb-1 text-muted"></i><div class="extra-small fw-bold">KM. Dalam</div></div>
                                <div class="border rounded-3 px-3 py-2 text-center flex-grow-1"><i data-lucide="layout-grid" size="20" class="mb-1 text-muted"></i><div class="extra-small fw-bold">Lemari</div></div>
                            @else
                                <div class="border rounded-3 px-3 py-2 text-center flex-grow-1"><i data-lucide="bed-single" size="20" class="mb-1 text-muted"></i><div class="extra-small fw-bold">Kasur</div></div>
                                <div class="border rounded-3 px-3 py-2 text-center flex-grow-1"><i data-lucide="bath" size="20" class="mb-1 text-muted"></i><div class="extra-small fw-bold">Kamar Mandi</div></div>
                                <div class="border rounded-3 px-3 py-2 text-center flex-grow-1"><i data-lucide="layout-grid" size="20" class="mb-1 text-muted"></i><div class="extra-small fw-bold">Lemari</div></div>
                            @endif
                        </div>
                    </div>

                    <div class="bg-light p-4 rounded-4 mb-4">
                        <div class="text-muted small text-uppercase fw-bold mb-1">Harga Sewa</div>
                        <h2 class="fw-800 text-orange mb-0">Rp {{ number_format($kamar->harga, 0, ',', '.') }}<span class="fs-6 text-muted fw-normal">/bulan</span></h2>
                    </div>
                    
                    @auth
                        @if(Auth::user()->role == 'customer')
                            <form action="{{ route('customer.booking') }}" method="POST">
                                @csrf
                                <input type="hidden" name="unit_id" value="{{ $kamar->id }}">
                                <div class="mb-4">
                                    <label class="form-label small fw-bold text-muted text-uppercase">Rencana Tanggal Masuk</label>
                                    <input type="date" name="tgl_masuk" class="form-control form-control-lg bg-light border-0 rounded-3" required min="{{ date('Y-m-d') }}">
                                </div>
                                <button type="submit" class="btn btn-orange w-100 py-3 rounded-pill fw-bold shadow-sm" style="font-size: 1.1rem;">BOOKING SEKARANG</button>
                            </form>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="btn btn-orange w-100 py-3 rounded-pill fw-bold shadow-sm d-flex justify-content-center align-items-center gap-2" style="font-size: 1.1rem;"><i data-lucide="log-in" size="20"></i> LOGIN UNTUK BOOKING</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

<style>
    /* Hover image effect */
    .group:hover img { transform: scale(1.05); }
    .group:hover .position-absolute { opacity: 1 !important; }
    .letter-spacing-1 { letter-spacing: 1px; }
</style>
@endsection
