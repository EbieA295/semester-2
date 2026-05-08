<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KostKita - Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root { --orange: #F47B20; --bg-gray: #F8F9FA; --text-dark: #111827; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: var(--bg-gray); color: var(--text-dark); }
        .navbar { background: white; border-bottom: 1px solid #E5E7EB; }
        .logo { font-weight: 800; color: var(--orange); text-decoration: none; font-size: 1.2rem; }
        .card { border-radius: 16px; border: none; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); }
        .btn-orange { background: var(--orange); color: white; font-weight: 600; border-radius: 10px; padding: 10px 20px; transition: 0.3s; }
        .btn-orange:hover { background: #d66a1a; color: white; transform: translateY(-2px); }
        .unit-card-img { height: 140px; background: #EEF2F6; border-radius: 12px 12px 0 0; display: flex; align-items: center; justify-content: center; font-size: 3rem; }
        .status-badge { position: absolute; top: 12px; right: 12px; border-radius: 20px; font-size: 10px; font-weight: 800; padding: 5px 12px; }
        .occupancy-box { width: 35px; height: 35px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 10px; font-weight: 700; color: white; }
        .table-custom { font-size: 13px; }
        .table-custom th { font-weight: 700; color: #6B7280; text-transform: uppercase; font-size: 11px; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg py-3">
    <div class="container-fluid px-4">
        <a class="logo" href="#">🏠 KostKita</a>
        <div class="ms-auto d-flex align-items-center">
            <div class="me-3 text-end d-none d-md-block">
                <div class="fw-bold small">Halo, {{ Auth::user()->name }} (Admin)</div>
                <a href="#" class="text-danger fw-bold text-decoration-none"
                    style="font-size: 11px;"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
            <button class="btn btn-orange btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambah">+ Tambah Unit Baru</button>
        </div>
    </div>
</nav>

<div class="container-fluid px-4 mt-4">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-8">
            <h4 class="fw-extrabold mb-4">Panel Manajemen Kamar</h4>
            <div class="card mb-4">
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="small fw-bold text-muted">Tipe Kamar</label>
                            <select class="form-select border-0 bg-light mt-1"><option>Semua Tipe</option></select>
                        </div>
                        <div class="col-md-3">
                            <label class="small fw-bold text-muted">Status Okupansi</label>
                            <select class="form-select border-0 bg-light mt-1"><option>Semua Status</option></select>
                        </div>
                        <div class="col-md-4">
                            <label class="small fw-bold text-muted">Cari ID Kamar</label>
                            <input type="text" class="form-control border-0 bg-light mt-1" placeholder="Misal: A101">
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button class="btn btn-orange w-100">🔍</button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="unitGrid" class="row row-cols-1 row-cols-md-3 g-4 mb-5"></div>
        </div>

        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h6 class="fw-bold mb-3">Panel Okupansi Global</h6>
                    <div id="occupancyPanel" class="d-flex flex-wrap gap-2"></div>
                    <div class="mt-3 d-flex gap-3 small">
                        <span><span class="badge bg-success">●</span> Tersedia</span>
                        <span><span class="badge bg-danger">●</span> Terisi</span>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body p-0">
                    <div class="p-3 border-bottom">
                        <h6 class="fw-bold mb-0">Transaksi & Pemesanan Global</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-custom mb-0">
                            <thead>
                                <tr class="bg-light">
                                    <th class="ps-3">ID Transk.</th>
                                    <th>Penyewa</th>
                                    <th>Unit</th>
                                    <th>Aksi</th> </tr>
                            </thead>
                            <tbody id="transactionTable">
                                @isset($bookings)
                                    @foreach($bookings as $booking)
                                    <tr>
                                        <td class="ps-3 fw-bold">#{{ $booking->created_at->format('Ymd') }}-{{ $booking->id }}</td>
                                        <td>{{ $booking->nama_penyewa }}</td>
                                        <td>{{ $booking->unit_id }}</td>
                                        <td>
                                            @if(strtolower($booking->status) == 'pending' || strtolower($booking->status) == 'panding')
                                                <form action="{{ route('admin.konfirmasiBooking', $booking->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-success py-0 px-2" style="font-size: 11px;">
                                                        Konfirmasi
                                                    </button>
                                                </form>
                                            @else
                                                <span class="badge bg-success" style="font-size: 10px;">Confirmed</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                @endisset
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const units = @json($units ?? []);

    function renderUnits() {
        const grid = document.getElementById('unitGrid');
        const occupancy = document.getElementById('occupancyPanel');
        grid.innerHTML = '';
        occupancy.innerHTML = '';

        units.forEach(unit => {
            const isAvailable = unit.status === 'Tersedia';
            const statusColor = isAvailable ? '#22C55E' : '#EF4444';
            const badgeClass = isAvailable ? 'bg-success' : 'bg-danger';

            grid.innerHTML += `
                <div class="col">
                    <div class="card h-100 position-relative overflow-hidden">
                        <div class="unit-card-img">🛏️</div>
                        <span class="status-badge ${badgeClass}">${unit.status}</span>
                        <div class="card-body p-4">
                            <h6 class="fw-bold mb-1">${unit.id}</h6>
                            <p class="text-muted small mb-3">KostKita - ${unit.lokasi}</p>
                            <div class="mb-3 small">❄️ AC 📶 WiFi 🚿 K.Mandi</div>
                            <div class="text-orange fw-bold mb-3">Rp ${parseInt(unit.harga).toLocaleString('id-ID')} <span class="text-muted small">/bln</span></div>
                            <div class="d-flex gap-2">
                                <button onclick="bukaModalPenyewa('${unit.id}')" class="btn btn-outline-dark btn-sm flex-grow-1" ${!isAvailable ? 'disabled' : ''}>${isAvailable ? 'Input Penyewa' : 'Terisi'}</button>
                                <button onclick="hapusUnit('${unit.id}')" class="btn btn-outline-danger btn-sm">🗑️</button>
                            </div>
                        </div>
                    </div>
                </div>`;
            occupancy.innerHTML += `<div class="occupancy-box" style="background: ${statusColor}" title="${unit.id}">${unit.id}</div>`;
        });
    }

    // Fungsi JS lainnya tetap sama
    function bukaModalPenyewa(id) {
        document.getElementById('in_unit_id').value = id;
        document.getElementById('text_unit_id').innerText = id;
        new bootstrap.Modal(document.getElementById('modalInputPenyewa')).show();
    }

    document.addEventListener('DOMContentLoaded', renderUnits);
</script>
</body>
</html>
