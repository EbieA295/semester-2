@extends('layouts.dashboard')

@section('title', 'Customer Dashboard')
@section('page_title', 'Cari Kost Impian')

@section('content')
<!-- Search & Filter Card -->
<div class="card border-0 rounded-4 p-4 p-md-5 mb-5 bg-white position-relative overflow-hidden" style="box-shadow: 0 10px 40px rgba(0,0,0,0.03);">
    <div class="position-absolute top-0 end-0 p-5 opacity-10" style="pointer-events: none;">
        <i data-lucide="search" size="200" class="text-orange"></i>
    </div>
    <div class="position-relative z-1">
        <h3 class="fw-800 mb-4 text-dark">Temukan Kost <span class="text-transparent" style="background: linear-gradient(135deg, var(--primary-orange), var(--accent-orange)); -webkit-background-clip: text; color: transparent;">Nyaman</span> Tanpa Ribet</h3>
        <form action="{{ route('customer.dashboard') }}" method="GET" class="row g-3 align-items-end">
            <div class="col-md-4">
                <label class="small fw-bold text-muted text-uppercase mb-2" style="letter-spacing: 1px;">Harga Maksimal</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-0 rounded-start-4 ps-4 fw-bold text-muted">Rp</span>
                    <input type="number" name="harga_max" class="form-control border-0 bg-light py-3 rounded-end-4" placeholder="Contoh: 2000000" value="{{ request('harga_max') }}">
                </div>
            </div>
            <div class="col-md-3">
                <label class="small fw-bold text-muted text-uppercase mb-2" style="letter-spacing: 1px;">Tipe Kost</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-0 rounded-start-4 ps-4"><i data-lucide="users" size="18" class="text-muted"></i></span>
                    <select name="tipe" class="form-select border-0 bg-light py-3 rounded-end-4">
                        <option value="Semua Tipe">Semua Tipe</option>
                        <option value="Hemat" {{ request('tipe') == 'Hemat' ? 'selected' : '' }}>Hemat</option>
                        <option value="Standar" {{ request('tipe') == 'Standar' ? 'selected' : '' }}>Standar</option>
                        <option value="Premium" {{ request('tipe') == 'Premium' ? 'selected' : '' }}>Premium</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <label class="small fw-bold text-muted text-uppercase mb-2" style="letter-spacing: 1px;">Lokasi</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-0 rounded-start-4 ps-4"><i data-lucide="map-pin" size="18" class="text-muted"></i></span>
                    <select class="form-select border-0 bg-light py-3 rounded-end-4">
                        <option>Semua Lokasi</option>
                        <option>Dekat Kampus</option>
                        <option>Pusat Kota</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-orange w-100 py-3 fw-bold rounded-4 shadow-sm d-flex justify-content-center align-items-center gap-2">
                    <i data-lucide="search" size="18"></i> CARI
                </button>
            </div>
        </form>
    </div>
</div>

<div class="row g-4">
    <!-- Main Content: Kost List -->
    <div class="col-lg-8">
        <h5 class="fw-bold mb-4 d-flex align-items-center gap-2 text-dark">
            <i data-lucide="sparkles" class="text-orange" size="24"></i> Rekomendasi Untukmu
        </h5>
        
        <div class="row g-4 mb-5">
            @forelse($units ?? [] as $unit)
            <div class="col-md-6">
                <div class="card border-0 rounded-4 h-100 card-premium overflow-hidden group">
                    <div class="position-relative overflow-hidden">
                        <img src="{{ $unit->image ? asset('storage/'.$unit->image) : ($unit->tipe == 'Premium' ? asset('images/rooms/premium.png') : asset('images/rooms/standard.png')) }}" class="card-img-top" style="height: 220px; object-fit: cover; transition: transform 0.5s;">
                        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(to bottom, rgba(0,0,0,0.1), rgba(0,0,0,0.6)); opacity: 0; transition: opacity 0.3s;"></div>
                        
                        <span class="badge {{ $unit->status == 'Tersedia' ? 'bg-success' : 'bg-danger' }} position-absolute top-0 end-0 m-3 px-3 py-2 rounded-pill shadow-sm border border-white" style="z-index: 10;">
                            {{ $unit->status }}
                        </span>
                        
                        <!-- Wishlist Button -->
                        <form action="{{ route('customer.wishlist.toggle', $unit->id) }}" method="POST" class="position-absolute top-0 start-0 m-3" style="z-index: 10;">
                            @csrf
                            <button type="submit" class="btn btn-white btn-sm rounded-circle shadow-sm border-0 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; transition: 0.2s;">
                                <i data-lucide="heart" size="18" class="{{ $unit->isWishlistedBy(Auth::id()) ? 'text-danger fill-danger' : 'text-muted' }}"></i>
                            </button>
                        </form>
                    </div>
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="fw-bold mb-0 text-truncate" style="max-width: 150px;">{{ $unit->id }} - {{ $unit->lokasi }}</h5>
                            <div class="text-warning small d-flex align-items-center bg-light px-2 py-1 rounded-pill">
                                <i data-lucide="star" fill="currentColor" size="14" class="me-1"></i> <span class="fw-bold text-dark">{{ number_format($unit->average_rating, 1) }}</span>
                            </div>
                        </div>
                        <p class="text-muted small mb-3">Tipe: <span class="fw-bold">{{ $unit->tipe }}</span></p>
                        
                        <div class="d-flex gap-2 mb-4 flex-wrap">
                            @if($unit->tipe == 'Premium')
                                <span class="badge bg-light text-dark fw-medium rounded-pill px-2 py-1 border"><i data-lucide="wind" size="12" class="me-1"></i> AC</span>
                                <span class="badge bg-light text-dark fw-medium rounded-pill px-2 py-1 border"><i data-lucide="wifi" size="12" class="me-1"></i> WiFi</span>
                            @endif
                            <span class="badge bg-light text-dark fw-medium rounded-pill px-2 py-1 border"><i data-lucide="bath" size="12" class="me-1"></i> K.Mandi</span>
                            <span class="badge bg-light text-dark fw-medium rounded-pill px-2 py-1 border"><i data-lucide="bed-single" size="12" class="me-1"></i> Kasur</span>
                            <span class="badge bg-light text-dark fw-medium rounded-pill px-2 py-1 border"><i data-lucide="layout-grid" size="12" class="me-1"></i> Lemari</span>
                        </div>

                        <div class="d-flex justify-content-between align-items-end mt-auto pt-3 border-top">
                            <div>
                                <span class="fw-800 text-orange h5 mb-0">Rp {{ number_format($unit->harga / 1000, 0) }}k</span>
                                <span class="text-muted extra-small">/bln</span>
                            </div>
                            @if($unit->status == 'Tersedia')
                                <button onclick="bukaModalBooking('{{ $unit->id }}')" class="btn btn-outline-orange rounded-pill px-4 fw-bold">Booking</button>
                            @else
                                <button class="btn btn-light rounded-pill px-4 fw-bold" disabled>Penuh</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <div class="p-5 bg-white rounded-5 shadow-sm border d-inline-block">
                    <i data-lucide="search-x" size="48" class="text-muted mb-3 opacity-50"></i>
                    <h5 class="fw-bold">Kamar tidak ditemukan</h5>
                    <p class="text-muted mb-0">Silakan ubah filter pencarian Anda.</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Sidebar: Activity & History -->
    <div class="col-lg-4">
        <div class="card border-0 rounded-4 shadow-sm p-4 bg-white mb-4 position-relative overflow-hidden">
            <h5 class="fw-bold mb-4 text-dark d-flex align-items-center gap-2">
                <i data-lucide="clock" size="20" class="text-orange"></i> Riwayat Booking
            </h5>
            <div class="d-grid gap-3 position-relative z-1">
                @forelse($myBookings ?? [] as $b)
                <div class="p-3 rounded-4 bg-light border position-relative overflow-hidden transition-all hover-shadow">
                    <div class="position-absolute top-0 start-0 h-100" style="width: 4px; background: var(--primary-orange);"></div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="fw-bold small">Unit {{ $b->unit_id }}</span>
                        <div class="d-flex gap-2 align-items-center">
                            @if($b->status == 'Confirmed')
                                <button onclick="bukaModalReview('{{ $b->unit_id }}')" class="btn btn-sm btn-white text-orange border px-2 py-0 rounded-pill d-flex align-items-center gap-1" style="font-size: 10px; height: 24px;"><i data-lucide="message-square" size="12"></i> Review</button>
                                <span class="badge bg-success rounded-pill px-2 py-1" style="font-size: 10px;">Aktif</span>
                            @elseif($b->status == 'Pending')
                                <span class="badge bg-warning text-dark rounded-pill px-2 py-1" style="font-size: 10px;">Menunggu Konfirmasi</span>
                            @elseif($b->status == 'Waiting for Payment')
                                <button onclick="bukaModalBayar('{{ $b->id }}', '{{ $b->total_harga }}')" class="btn btn-orange btn-sm py-0 px-3 rounded-pill" style="font-size: 10px; height: 24px;">Bayar</button>
                            @endif
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-muted extra-small d-flex align-items-center gap-1"><i data-lucide="calendar" size="12"></i> {{ \Carbon\Carbon::parse($b->tgl_masuk)->format('d M Y') }}</div>
                        <div class="extra-small fw-bold {{ $b->payment_status == 'Paid' ? 'text-success' : 'text-danger' }}">
                            {{ $b->payment_status ?? 'Unpaid' }}
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-4">
                    <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                        <i data-lucide="calendar-x" class="text-muted opacity-50" size="24"></i>
                    </div>
                    <p class="text-muted small fw-medium mb-0">Belum ada riwayat booking</p>
                </div>
                @endforelse
            </div>
        </div>

        <div class="card border-0 rounded-4 shadow-lg p-4 text-white overflow-hidden position-relative" style="background: linear-gradient(135deg, var(--primary-orange), var(--secondary-orange));">
            <div class="position-absolute top-0 end-0 opacity-25" style="transform: translate(20%, -20%);">
                <i data-lucide="headphones" size="120"></i>
            </div>
            <div class="position-relative z-1">
                <h5 class="fw-800 mb-2">Butuh Bantuan?</h5>
                <p class="small opacity-75 mb-4 pe-4">Tim support kami siap membantu Anda 24/7 untuk masalah booking dan fasilitas.</p>
                <a href="#" class="btn btn-white rounded-pill fw-bold px-4 shadow-sm" style="color: var(--primary-orange);">Hubungi CS</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal Booking -->
<div class="modal fade" id="modalBooking" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg p-2">
            <div class="modal-header border-0 pb-0 pt-4 px-4">
                <h4 class="fw-800">Konfirmasi Booking</h4>
                <button type="button" class="btn-close bg-light rounded-circle p-2" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('customer.booking') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <input type="hidden" id="book_unit_id" name="unit_id">
                    <div class="text-center mb-4 bg-soft-orange p-4 rounded-4 border">
                        <div class="display-4 mb-2">🏠</div>
                        <h3 class="fw-800 text-orange mt-2 mb-1" id="display_unit_id">A101</h3>
                        <p class="text-muted small mb-0">Pastikan data Anda sudah benar sebelum memesan.</p>
                    </div>
                    <div class="mb-4">
                        <label class="small fw-bold text-muted text-uppercase mb-2" style="letter-spacing: 1px;">Tanggal Masuk Kost</label>
                        <input type="date" name="tgl_masuk" class="form-control form-control-lg border-0 bg-light rounded-4" required min="{{ date('Y-m-d') }}">
                    </div>
                    <div class="mb-4">
                        <label class="small fw-bold text-muted text-uppercase mb-2" style="letter-spacing: 1px;">Nomor WhatsApp Aktif</label>
                        <input type="text" name="no_hp" class="form-control form-control-lg border-0 bg-light rounded-4" placeholder="08123456789" required value="{{ Auth::user()->no_hp }}">
                    </div>
                    <div class="bg-light p-3 rounded-4 small text-muted mb-2 d-flex align-items-start gap-2 border">
                        <i data-lucide="info" size="18" class="text-primary mt-1 flex-shrink-0"></i> 
                        <span>Konfirmasi booking akan dikirimkan oleh Admin melalui WA. Pastikan nomor aktif.</span>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="submit" class="btn btn-orange w-100 py-3 rounded-pill fw-bold shadow-sm" style="font-size: 1.1rem;">BOOKING SEKARANG</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Bayar -->
<div class="modal fade" id="modalBayar" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg p-2">
            <div class="modal-header border-0 pb-0 pt-4 px-4">
                <h4 class="fw-800">Upload Pembayaran</h4>
                <button type="button" class="btn-close bg-light rounded-circle p-2" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('customer.uploadPayment') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-4">
                    <input type="hidden" id="pay_booking_id" name="booking_id">
                    <div class="bg-soft-orange p-4 rounded-4 mb-4 text-center border">
                        <p class="small text-muted mb-2 text-uppercase fw-bold" style="letter-spacing: 1px;">Total yang harus dibayar</p>
                        <h2 class="fw-800 text-orange mb-0" id="display_total_harga">Rp 0</h2>
                    </div>
                    <div class="mb-4">
                        <label class="small fw-bold text-muted text-uppercase mb-2" style="letter-spacing: 1px;">Pilih File Bukti Transfer</label>
                        <input type="file" name="payment_proof" class="form-control form-control-lg border-0 bg-light rounded-4" required accept="image/*">
                    </div>
                    <div class="alert alert-info border-0 bg-light rounded-4 mb-0 d-flex gap-3">
                        <i data-lucide="credit-card" size="24" class="text-primary"></i>
                        <div>
                            <div class="fw-bold mb-1 text-dark">Transfer ke Rekening KostKita</div>
                            <div class="small text-muted"><strong>Bank BCA: 1234567890</strong><br>a.n. KostKita App</div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="submit" class="btn btn-orange w-100 py-3 rounded-pill fw-bold shadow-sm">UPLOAD BUKTI</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Review -->
<div class="modal fade" id="modalReview" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg p-2">
            <div class="modal-header border-0 pb-0 pt-4 px-4">
                <h4 class="fw-800">Berikan Ulasan</h4>
                <button type="button" class="btn-close bg-light rounded-circle p-2" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('customer.review.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <input type="hidden" id="rev_unit_id" name="unit_id">
                    <div class="mb-4 text-center">
                        <label class="small fw-bold text-muted text-uppercase mb-3" style="letter-spacing: 1px;">Pilih Rating</label>
                        <div class="d-flex justify-content-center gap-2">
                            @foreach(range(1, 5) as $star)
                                <input type="radio" class="btn-check" name="rating" id="star{{ $star }}" value="{{ $star }}" required>
                                <label class="btn btn-outline-warning rounded-circle d-flex align-items-center justify-content-center" for="star{{ $star }}" style="width: 45px; height: 45px; font-size: 1.2rem;">{{ $star }}</label>
                            @endforeach
                        </div>
                    </div>
                    <div class="mb-2">
                        <label class="small fw-bold text-muted text-uppercase mb-2" style="letter-spacing: 1px;">Ulasan Anda</label>
                        <textarea name="comment" class="form-control border-0 bg-light rounded-4 p-3" rows="4" placeholder="Bagaimana pengalaman Anda tinggal di sini?" required></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="submit" class="btn btn-orange w-100 py-3 rounded-pill fw-bold shadow-sm">KIRIM ULASAN</button>
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

    function bukaModalBayar(id, harga) {
        document.getElementById('pay_booking_id').value = id;
        document.getElementById('display_total_harga').innerText = 'Rp ' + parseInt(harga).toLocaleString('id-ID');
        new bootstrap.Modal(document.getElementById('modalBayar')).show();
    }
</script>

<style>
    /* Hover effects */
    .group:hover img { transform: scale(1.05); }
    .group:hover .position-absolute { opacity: 1 !important; }
    .hover-shadow { transition: all 0.3s ease; }
    .hover-shadow:hover { box-shadow: 0 10px 20px rgba(0,0,0,0.05); transform: translateY(-2px); }
</style>
@endsection
