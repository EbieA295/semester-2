@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="bg-soft-orange" style="padding: 100px 0;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <span class="badge bg-white text-orange px-3 py-2 rounded-pill shadow-sm mb-3 fw-bold">#1 Kost App di Kampus</span>
                <h1 class="display-3 fw-800 mb-4 text-dark">Cari Kost <span class="text-orange">Nyaman</span> Tanpa Ribet.</h1>
                <p class="lead text-muted mb-5">Platform penyewaan kost modern dengan sistem booking instan dan pembayaran aman. Temukan kamar impianmu sekarang!</p>
                <div class="d-flex gap-3">
                    <a href="#daftar-kamar" class="btn btn-orange px-4 py-3">Cari Kamar</a>
                    <a href="/register" class="btn btn-outline-orange px-4 py-3">Daftar Akun</a>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="https://images.unsplash.com/photo-1522770179533-24471fcdba45?auto=format&fit=crop&q=80&w=1000" class="img-fluid rounded-5 shadow-lg" alt="Hero Image">
            </div>
        </div>
    </div>
</div>

<!-- Search Filter Section -->
<div class="container" style="margin-top: -50px;">
    <div class="bg-white rounded-4 shadow-lg p-4">
        <form action="/" method="GET" class="row g-3">
            <div class="col-md-4">
                <label class="small fw-bold text-muted mb-2 text-uppercase">Cari Lokasi</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-0"><i data-lucide="map-pin" size="18" class="text-orange"></i></span>
                    <input type="text" name="lokasi" class="form-control bg-light border-0 py-3" placeholder="Contoh: Dekat UNILA" value="{{ request('lokasi') }}">
                </div>
            </div>
            <div class="col-md-3">
                <label class="small fw-bold text-muted mb-2 text-uppercase">Tipe Kamar</label>
                <select name="tipe" class="form-select bg-light border-0 py-3">
                    <option value="Semua Tipe">Semua Tipe</option>
                    <option value="Reguler" {{ request('tipe') == 'Reguler' ? 'selected' : '' }}>Reguler</option>
                    <option value="Premium" {{ request('tipe') == 'Premium' ? 'selected' : '' }}>Premium</option>
                    <option value="Eksklusif" {{ request('tipe') == 'Eksklusif' ? 'selected' : '' }}>Eksklusif</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="small fw-bold text-muted mb-2 text-uppercase">Harga Maks</label>
                <input type="number" name="harga_max" class="form-control bg-light border-0 py-3" placeholder="Rp 2.000.000" value="{{ request('harga_max') }}">
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-orange w-100 py-3 rounded-4 fw-bold">CARI</button>
            </div>
        </form>
    </div>
</div>

<!-- Room List Section -->
<div id="daftar-kamar" class="py-5 container">
    <div class="d-flex justify-content-between align-items-end mb-5">
        <div>
            <h6 class="text-orange fw-bold text-uppercase mb-2">Pilihan Terbaik</h6>
            <h2 class="fw-800">Rekomendasi Kost Untukmu</h2>
        </div>
        <div>
            <span class="text-muted">{{ count($semuaKamar) }} Kamar ditemukan</span>
        </div>
    </div>

    <div class="row g-4">
        @forelse($semuaKamar ?? [] as $kamar)
        <div class="col-lg-4 col-md-6">
            <div class="card border-0 rounded-4 shadow-sm h-100 card-premium">
                <div class="position-relative">
                    <img src="{{ $kamar->image ? asset('storage/'.$kamar->image) : 'https://images.unsplash.com/photo-1522770179533-24471fcdba45?auto=format&fit=crop&q=80&w=1000' }}" class="card-img-top rounded-top-4" style="height: 200px; object-fit: cover;">
                    @auth
                    <form action="{{ route('customer.wishlist.toggle', $kamar->id) }}" method="POST" class="position-absolute top-0 end-0 m-3">
                        @csrf
                        @php $isWishlisted = Auth::user()->wishlists()->where('unit_id', $kamar->id)->exists(); @endphp
                        <button type="submit" class="btn {{ $isWishlisted ? 'btn-orange' : 'btn-white bg-white text-orange' }} rounded-circle p-2 shadow-sm border-0" style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;">
                            <i data-lucide="heart" size="16" style="{{ $isWishlisted ? 'fill: white' : '' }}"></i>
                        </button>
                    </form>
                    @endauth
                </div>
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-1">{{ $kamar->id }} - {{ $kamar->tipe }}</h5>
                    <p class="text-muted small mb-3"><i data-lucide="map-pin" size="14" class="me-1 text-orange"></i> {{ $kamar->lokasi }}</p>
                    
                    <div class="d-flex justify-content-between align-items-center pt-3 border-top mt-auto">
                        <span class="fw-bold text-orange h5 mb-0">Rp {{ number_format($kamar->harga, 0, ',', '.') }}</span>
                        <button type="button" class="btn btn-outline-orange btn-sm rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#modalDetail{{ $kamar->id }}">Detail</button>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <p class="text-muted">Kamar tidak ditemukan.</p>
        </div>
        @endforelse
    </div>
</div>

<!-- Modals Detail -->
@foreach($semuaKamar ?? [] as $kamar)
<div class="modal fade" id="modalDetail{{ $kamar->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-header border-0 p-4 pb-0">
                <h5 class="fw-bold">{{ $kamar->id }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <img src="{{ $kamar->image ? asset('storage/'.$kamar->image) : 'https://images.unsplash.com/photo-1522770179533-24471fcdba45?auto=format&fit=crop&q=80&w=1000' }}" class="img-fluid rounded-4 mb-3">
                <p><strong>Tipe:</strong> {{ $kamar->tipe }}</p>
                <p><strong>Lokasi:</strong> {{ $kamar->lokasi }}</p>
                <p><strong>Harga:</strong> Rp {{ number_format($kamar->harga, 0, ',', '.') }}</p>
                
                @auth
                    @if(Auth::user()->role == 'customer')
                        <form action="{{ route('customer.booking') }}" method="POST">
                            @csrf
                            <input type="hidden" name="unit_id" value="{{ $kamar->id }}">
                            <div class="mb-3">
                                <label class="form-label small fw-bold">TANGGAL MASUK</label>
                                <input type="date" name="tgl_masuk" class="form-control" required min="{{ date('Y-m-d') }}">
                            </div>
                            <button type="submit" class="btn btn-orange w-100 py-3 rounded-4 fw-bold">BOOKING SEKARANG</button>
                        </form>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="btn btn-orange w-100 py-3 rounded-4 fw-bold">LOGIN UNTUK BOOKING</a>
                @endauth
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection
