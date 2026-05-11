@extends('layouts.dashboard')

@section('title', 'Customer Dashboard')
@section('page_title', 'Cari Kost Impian')

@section('content')
<!-- Search & Filter Card -->
<div class="card border-0 rounded-4 shadow-sm p-4 mb-5 bg-white">
    <h4 class="fw-800 mb-4 text-center">Temukan Kost <span class="text-orange">Nyaman</span> Tanpa Ribet</h4>
    <form action="{{ route('customer.dashboard') }}" method="GET" class="row g-3">
        <div class="col-md-4">
            <label class="small fw-bold text-muted text-uppercase mb-2">Harga Maksimal</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-0 rounded-start-3">Rp</span>
                <input type="number" name="harga_max" class="form-control border-0 bg-light py-2 rounded-end-3" placeholder="Contoh: 2000000" value="{{ request('harga_max') }}">
            </div>
        </div>
        <div class="col-md-3">
            <label class="small fw-bold text-muted text-uppercase mb-2">Tipe Kost</label>
            <select name="tipe" class="form-select border-0 bg-light py-2 rounded-3">
                <option value="Semua Tipe">Semua Tipe</option>
                <option value="Putra" {{ request('tipe') == 'Putra' ? 'selected' : '' }}>Putra</option>
                <option value="Putri" {{ request('tipe') == 'Putri' ? 'selected' : '' }}>Putri</option>
            </select>
        </div>
        <div class="col-md-3">
            <label class="small fw-bold text-muted text-uppercase mb-2">Lokasi</label>
            <select class="form-select border-0 bg-light py-2 rounded-3">
                <option>Semua Lokasi</option>
                <option>Dekat Kampus</option>
                <option>Pusat Kota</option>
            </select>
        </div>
        <div class="col-md-2 d-flex align-items-end">
            <button type="submit" class="btn btn-orange w-100 py-2 fw-bold">CARI</button>
        </div>
    </form>
</div>

<div class="row g-4">
    <!-- Main Content: Kost List -->
    <div class="col-lg-8">
        <h5 class="fw-bold mb-4 d-flex align-items-center">
            <i data-lucide="sparkles" class="text-orange me-2" size="20"></i> Rekomendasi Untukmu
        </h5>
        
        <div class="row g-4 mb-5">
            @forelse($units ?? [] as $unit)
            <div class="col-md-6">
                <div class="card border-0 rounded-4 shadow-sm overflow-hidden bg-white h-100 card-premium">
                    <div class="position-relative">
                        <img src="https://images.unsplash.com/photo-1522770179533-24471fcdba45?auto=format&fit=crop&q=80&w=1000" class="card-img-top" style="height: 200px; object-fit: cover;">
                        <span class="badge {{ $unit->status == 'Tersedia' ? 'bg-success' : 'bg-danger' }} position-absolute top-0 end-0 m-3 px-3 py-2 rounded-pill shadow-sm" style="z-index: 10;">
                            {{ $unit->status }}
                        </span>
                        
                        <!-- Wishlist Button -->
                        <form action="{{ route('customer.wishlist.toggle', $unit->id) }}" method="POST" class="position-absolute top-0 start-0 m-3" style="z-index: 10;">
                            @csrf
                            <button type="submit" class="btn btn-white btn-sm rounded-circle shadow-sm border-0 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                <i data-lucide="heart" size="18" class="{{ $unit->isWishlistedBy(Auth::id()) ? 'text-danger fill-danger' : 'text-muted' }}"></i>
                            </button>
                        </form>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h6 class="fw-bold mb-0 text-truncate" style="max-width: 150px;">{{ $unit->id }} - {{ $unit->lokasi }}</h6>
                            <div class="text-warning small d-flex align-items-center">
                                <i data-lucide="star" fill="currentColor" size="14" class="me-1"></i> {{ number_format($unit->average_rating, 1) }}
                            </div>
                        </div>
                        <p class="text-muted extra-small mb-3">Tipe: {{ $unit->tipe }}</p>
                        
                        <div class="d-flex gap-2 mb-4">
                            <div class="badge bg-light text-dark fw-medium rounded-pill px-2 py-1" style="font-size: 10px;">❄️ AC</div>
                            <div class="badge bg-light text-dark fw-medium rounded-pill px-2 py-1" style="font-size: 10px;">📶 WiFi</div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <span class="fw-800 text-orange h5 mb-0">Rp {{ number_format($unit->harga / 1000, 0) }}k</span>
                                <span class="text-muted extra-small">/bln</span>
                            </div>
                            @if($unit->status == 'Tersedia')
                                <button onclick="bukaModalBooking('{{ $unit->id }}')" class="btn btn-outline-orange btn-sm rounded-pill px-3 fw-bold">Booking</button>
                            @else
                                <button class="btn btn-light btn-sm rounded-pill px-3 fw-bold" disabled>Penuh</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted italic">Kamar tidak ditemukan dengan kriteria tersebut.</p>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Sidebar: Activity & History -->
    <div class="col-lg-4">
        <div class="card border-0 rounded-4 shadow-sm p-4 bg-white mb-4">
            <h6 class="fw-bold mb-4">Riwayat Booking Saya</h6>
            <div class="d-grid gap-3">
                @forelse($myBookings ?? [] as $b)
                <div class="p-3 rounded-4 bg-light bg-opacity-50 border position-relative overflow-hidden">
                    <div class="position-absolute top-0 start-0 h-100 bg-orange" style="width: 4px; background: var(--primary-orange);"></div>
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span class="fw-bold small">Unit {{ $b->unit_id }}</span>
                        <div class="d-flex gap-2 align-items-center">
                            @if($b->status == 'Confirmed')
                                <button onclick="bukaModalReview('{{ $b->unit_id }}')" class="btn btn-soft-orange p-0 border-0" style="font-size: 10px;"><i data-lucide="message-square" size="14"></i> Review</button>
                            @endif
                            <span class="badge {{ $b->status == 'Confirmed' ? 'bg-success' : 'bg-warning' }} rounded-pill" style="font-size: 10px;">{{ $b->status }}</span>
                        </div>
                    </div>
                    <div class="text-muted extra-small">{{ \Carbon\Carbon::parse($b->tgl_masuk)->format('d M Y') }}</div>
                </div>
                @empty
                <div class="text-center py-4">
                    <i data-lucide="calendar-x" class="text-muted opacity-25 mb-2" size="32"></i>
                    <p class="text-muted extra-small mb-0">Belum ada riwayat booking</p>
                </div>
                @endforelse
            </div>
        </div>

        <div class="card border-0 rounded-4 shadow-lg p-4 bg-orange text-white" style="background: linear-gradient(135deg, var(--primary-orange), var(--secondary-orange));">
            <h6 class="fw-bold mb-3">Butuh Bantuan?</h6>
            <p class="small opacity-75 mb-4">Tim support kami siap membantu Anda 24/7 untuk masalah booking dan fasilitas.</p>
            <a href="#" class="btn btn-white w-100 rounded-pill fw-bold" style="background: white; color: var(--primary-orange);">Hubungi CS</a>
        </div>
    </div>
</div>

<!-- Modal Booking -->
<div class="modal fade" id="modalBooking" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-5 overflow-hidden">
            <div class="modal-header border-0 pb-0 pt-4 px-4">
                <h5 class="fw-bold">Konfirmasi Booking</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('customer.booking') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <input type="hidden" id="book_unit_id" name="unit_id">
                    <div class="text-center mb-4 bg-soft-orange p-4 rounded-5">
                        <div class="display-3 mb-2">🏠</div>
                        <h4 class="fw-800 text-orange mt-2" id="display_unit_id">A101</h4>
                        <p class="text-muted small mb-0">Pastikan data Anda sudah benar sebelum memesan.</p>
                    </div>
                    <div class="mb-4">
                        <label class="small fw-bold text-muted text-uppercase mb-2">Tanggal Masuk Kost</label>
                        <input type="date" name="tgl_masuk" class="form-control form-control-lg border-0 bg-light rounded-4" required min="{{ date('Y-m-d') }}">
                    </div>
                    <div class="mb-4">
                        <label class="small fw-bold text-muted text-uppercase mb-2">Nomor WhatsApp Aktif</label>
                        <input type="text" name="no_hp" class="form-control form-control-lg border-0 bg-light rounded-4" placeholder="08123456789" required value="{{ Auth::user()->no_hp }}">
                    </div>
                    <div class="bg-light p-3 rounded-4 small text-muted mb-3">
                        <i data-lucide="info" size="16" class="me-2"></i> Konfirmasi booking akan dikirimkan oleh Admin melalui WA.
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="submit" class="btn btn-orange w-100 py-3 rounded-4 fw-bold">BOOKING SEKARANG</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Review -->
<div class="modal fade" id="modalReview" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-5 overflow-hidden">
            <div class="modal-header border-0 pb-0 pt-4 px-4">
                <h5 class="fw-bold">Berikan Ulasan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('customer.review.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <input type="hidden" id="rev_unit_id" name="unit_id">
                    <div class="mb-4">
                        <label class="small fw-bold text-muted text-uppercase mb-2">Rating</label>
                        <div class="d-flex gap-2">
                            @foreach(range(1, 5) as $star)
                                <input type="radio" class="btn-check" name="rating" id="star{{ $star }}" value="{{ $star }}" required>
                                <label class="btn btn-outline-warning rounded-pill px-3" for="star{{ $star }}">{{ $star }} ⭐</label>
                            @endforeach
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="small fw-bold text-muted text-uppercase mb-2">Ulasan Anda</label>
                        <textarea name="comment" class="form-control border-0 bg-light rounded-4" rows="4" placeholder="Bagaimana pengalaman Anda tinggal di sini?" required></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="submit" class="btn btn-orange w-100 py-3 rounded-4 fw-bold">KIRIM ULASAN</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function bukaModalBooking(id) {
        document.getElementById('book_unit_id').value = id;
        document.getElementById('display_unit_id').innerText = id;
        new bootstrap.Modal(document.getElementById('modalBooking')).show();
    }

    function bukaModalReview(id) {
        document.getElementById('rev_unit_id').value = id;
        new bootstrap.Modal(document.getElementById('modalReview')).show();
    }
</script>

<style>
    .card-premium {
        transition: transform 0.3s ease;
    }
    .card-premium:hover {
        transform: translateY(-5px);
    }
</style>
@endsection
