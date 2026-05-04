<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KostKita - Temukan Kost Impian</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root { --orange: #F47B20; --bg-gray: #F8F9FA; --text-dark: #111827; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: var(--bg-gray); color: var(--text-dark); }
        .navbar { background: white; border-bottom: 1px solid #E5E7EB; }
        .logo { font-weight: 800; color: var(--orange); text-decoration: none; font-size: 1.2rem; }
        .nav-link { font-weight: 600; font-size: 14px; color: #6B7280; }
        .nav-link.active { color: var(--orange); }
        .card { border-radius: 16px; border: none; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); }
        .btn-orange { background: var(--orange); color: white; font-weight: 600; border-radius: 10px; padding: 10px 20px; transition: 0.3s; }
        .btn-orange:hover { background: #d66a1a; color: white; transform: translateY(-2px); }
        .unit-card-img { height: 160px; background: #EEF2F6; border-radius: 12px 12px 0 0; display: flex; align-items: center; justify-content: center; font-size: 4rem; }
        .status-badge { position: absolute; top: 12px; right: 12px; border-radius: 20px; font-size: 10px; font-weight: 800; padding: 5px 12px; }
        .occupancy-box { width: 35px; height: 35px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 10px; font-weight: 700; color: white; }
        .table-custom { font-size: 12px; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg py-3">
    <div class="container-fluid px-4">
        <a class="logo" href="#">🏠 KostKita</a>
        <div class="collapse navbar-collapse ms-5">
            <ul class="navbar-nav gap-3">
                <li class="nav-item"><a class="nav-link active" href="#">Cari Kost</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Promo</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Tentang Kami</a></li>
            </ul>
        </div>
        <div class="ms-auto d-flex align-items-center">
            <div class="dropdown">
                <button class="btn btn-light dropdown-toggle rounded-pill px-3 shadow-sm border" data-bs-toggle="dropdown">
                    👤 Halo, {{ Auth::user()->name }}
                </button>
                <ul class="dropdown-menu dropdown-menu-end border-0 shadow mt-2">
                    <li><a class="dropdown-item small" href="#">Profil Saya</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item small text-danger">Keluar</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<div class="container-fluid px-4 mt-4">
    <!-- Alert Success -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
            <strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- Filter Search ala Agoda -->
            <div class="card mb-4 p-4 shadow-sm">
                <h3 class="fw-800 mb-4 text-center">Temukan Kost Impianmu Tanpa Ribet</h3>
                <form action="{{ route('customer.dashboard') }}" method="GET" class="row g-3">
                    <div class="col-md-4">
                        <label class="small fw-bold text-muted">HARGA MAKSIMAL</label>
                        <input type="number" name="harga_max" class="form-control border-0 bg-light mt-1" placeholder="Contoh: 2000000" value="{{ request('harga_max') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="small fw-bold text-muted">TIPE</label>
                        <select name="tipe" class="form-select border-0 bg-light mt-1">
                            <option value="Semua Tipe">Semua Tipe</option>
                            <option value="Putra" {{ request('tipe') == 'Putra' ? 'selected' : '' }}>Putra</option>
                            <option value="Putri" {{ request('tipe') == 'Putri' ? 'selected' : '' }}>Putri</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="small fw-bold text-muted">FASILITAS</label>
                        <select class="form-select border-0 bg-light mt-1"><option>Semua</option></select>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-orange w-100">Cari</button>
                    </div>
                </form>
            </div>

            <h5 class="fw-bold mb-3">Rekomendasi Kost</h5>
            <div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
                @forelse($units as $unit)
                <div class="col">
                    <div class="card h-100 position-relative">
                        <div class="unit-card-img">🛏️</div>
                        @php
                            $badgeClass = $unit->status == 'Tersedia' ? 'bg-success' : ($unit->status == 'Terisi' ? 'bg-danger' : 'bg-warning');
                        @endphp
                        <span class="status-badge {{ $badgeClass }}">
                            {{ $unit->status }}
                        </span>
                        <div class="card-body p-4">
                            <h6 class="fw-bold mb-1">{{ $unit->id }}</h6>
                            <p class="text-muted small mb-2">KostKita - {{ $unit->lokasi }} ({{ $unit->tipe }})</p>
                            <div class="mb-3 small">❄️ AC 📶 WiFi 🚿 K.Mandi</div>
                            <div class="text-orange fw-extrabold mb-3">Rp {{ number_format($unit->harga, 0, ',', '.') }} <span class="text-muted small">/bln</span></div>
                            
                            @if($unit->status == 'Tersedia')
                                <button onclick="bukaModalBooking('{{ $unit->id }}')" class="btn btn-outline-dark btn-sm w-100 rounded-pill">Cek Detail & Booking</button>
                            @else
                                <button class="btn btn-secondary btn-sm w-100 rounded-pill" disabled>Tidak Tersedia</button>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5 text-muted">
                    <p>Kamar tidak ditemukan dengan filter tersebut.</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <div class="card mb-4 p-4">
                <h6 class="fw-bold mb-3 text-center">Status Ketersediaan Kamar</h6>
                <div class="d-flex flex-wrap gap-2 justify-content-center">
                    @foreach($units as $unit)
                        @php
                            $color = $unit->status == 'Tersedia' ? '#22C55E' : ($unit->status == 'Terisi' ? '#EF4444' : '#F47B20');
                        @endphp
                        <div class="occupancy-box shadow-sm" style="background: {{ $color }}" title="{{ $unit->id }}">
                            {{ $unit->id }}
                        </div>
                    @endforeach
                </div>
                <div class="mt-4 d-flex justify-content-center gap-3 small text-muted">
                    <span><span class="badge bg-success">●</span> Tersedia</span>
                    <span><span class="badge bg-danger">●</span> Terisi</span>
                    <span><span class="badge bg-warning">●</span> Dipesan</span>
                </div>
            </div>

            <div class="card p-0 overflow-hidden shadow-sm">
                <div class="p-3 border-bottom bg-light d-flex justify-content-between align-items-center">
                    <h6 class="fw-bold mb-0">Riwayat Booking Saya</h6>
                    <span class="badge bg-white text-dark border">{{ count($myBookings ?? []) }}</span>
                </div>
                <div class="table-responsive">
                    <table class="table table-custom table-hover mb-0">
                        <thead>
                            <tr class="bg-light">
                                <th class="ps-3">UNIT</th>
                                <th>MASUK</th>
                                <th>STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($myBookings ?? [] as $b)
                            <tr>
                                <td class="ps-3 fw-bold">{{ $b->unit_id }}</td>
                                <td>{{ \Carbon\Carbon::parse($b->tgl_masuk)->format('d/m/Y') }}</td>
                                <td>
                                    <span class="badge {{ $b->status == 'Confirmed' ? 'bg-success' : 'bg-warning' }}">
                                        {{ $b->status }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center py-3 text-muted small">Belum ada riwayat booking</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Booking -->
<div class="modal fade" id="modalBooking" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 pb-0">
                <h5 class="fw-bold">Konfirmasi Booking</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('customer.booking') }}" method="POST">
                @csrf
                <div class="modal-body py-4">
                    <input type="hidden" id="book_unit_id" name="unit_id">
                    <div class="text-center mb-4">
                        <div class="display-1">🏠</div>
                        <h4 class="fw-bold mt-2" id="display_unit_id">A101</h4>
                        <p class="text-muted small">Pastikan tanggal check-in sudah benar</p>
                    </div>
                    <div class="form-group">
                        <label class="small fw-bold mb-2">Pilih Tanggal Masuk Kost</label>
                        <input type="date" name="tgl_masuk" class="form-control form-control-lg border-0 bg-light" required min="{{ date('Y-m-d') }}">
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="submit" class="btn btn-orange w-100 py-3 shadow">Booking Sekarang</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function bukaModalBooking(id) {
        document.getElementById('book_unit_id').value = id;
        document.getElementById('display_unit_id').innerText = id;
        new bootstrap.Modal(document.getElementById('modalBooking')).show();
    }
</script>
</body>
</html>