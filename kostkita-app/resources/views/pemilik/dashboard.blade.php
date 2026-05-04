<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pemilik - KostKita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root { --orange: #F47B20; }
        body { background-color: #f4f7f6; font-family: 'Plus Jakarta Sans', sans-serif; }
        .sidebar { background: white; min-height: 100vh; border-right: 1px solid #e0e0e0; }
        .nav-link { color: #666; font-weight: 500; padding: 12px 20px; border-radius: 10px; margin-bottom: 5px; }
        .nav-link.active { background: var(--orange); color: white; }
        .stat-card { border: none; border-radius: 15px; transition: 0.3s; }
        .stat-card:hover { transform: translateY(-5px); }
        .text-orange { color: var(--orange); }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 sidebar p-3 d-none d-md-block">
                <h4 class="fw-bold text-orange mb-4 px-3">🏠 KostKita</h4>
                <nav class="nav flex-column">
                    <a class="nav-link active" href="#"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a>
                    <a class="nav-link" href="#"><i class="bi bi-house-door me-2"></i> Data Kamar</a>
                    <a class="nav-link" href="#"><i class="bi bi-wallet2 me-2"></i> Keuangan</a>
                    <hr>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="nav-link text-danger border-0 bg-transparent w-100 text-start">
                            <i class="bi bi-box-arrow-right me-2"></i> Keluar
                        </button>
                    </form>
                </nav>
            </div>

            <!-- Main Content -->
            <div class="col-md-10 p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h3 class="fw-bold">Ringkasan Bisnis</h3>
                        <p class="text-muted">Pantau pendapatan dan okupansi kost Anda</p>
                    </div>
                    <div class="text-end">
                        <h5 class="fw-bold mb-0 text-capitalize">{{ Auth::user()->name }}</h5>
                        <span class="badge bg-primary">Owner Mode</span>
                    </div>
                </div>

                <!-- Statistik Bar -->
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="card stat-card shadow-sm p-4 bg-white">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="text-muted small mb-1">Total Pendapatan</p>
                                    <h4 class="fw-bold mb-0 text-success">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h4>
                                </div>
                                <div class="bg-success bg-opacity-10 p-3 rounded-circle text-success">
                                    <i class="bi bi-currency-dollar fs-4"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card stat-card shadow-sm p-4 bg-white">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="text-muted small mb-1">Kamar Tersedia</p>
                                    <h4 class="fw-bold mb-0 text-warning">{{ $unitTersedia }} Unit</h4>
                                </div>
                                <div class="bg-warning bg-opacity-10 p-3 rounded-circle text-warning">
                                    <i class="bi bi-door-open fs-4"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card stat-card shadow-sm p-4 bg-white">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="text-muted small mb-1">Okupansi Terisi</p>
                                    <h4 class="fw-bold mb-0 text-danger">{{ $unitTerisi }} Unit</h4>
                                </div>
                                <div class="bg-danger bg-opacity-10 p-3 rounded-circle text-danger">
                                    <i class="bi bi-people fs-4"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Aktivitas Terkini -->
                <div class="card border-0 shadow-sm mt-4 p-4 rounded-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold mb-0">Booking Terkini</h5>
                        <button class="btn btn-sm btn-outline-primary border-0">Lihat Semua</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr class="small text-uppercase">
                                    <th>Penyewa</th>
                                    <th>Nomor Unit</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($bookingTerbaru as $b)
                                <tr>
                                    <!-- Pengaman data jika user/unit di database tidak sinkron -->
                                    <td class="fw-bold text-capitalize">{{ $b->user->name ?? 'User: ' . $b->nama_penyewa }}</td>
                                    <td><span class="badge bg-light text-dark border">{{ $b->unit->nama_unit ?? 'Unit ID: ' . $b->unit_id }}</span></td>
                                    <td>{{ $b->created_at->format('d M Y') }}</td>
                                    <td>
                                        @if(strtolower($b->status) == 'confirmed' || strtolower($b->status) == 'lunas')
                                            <span class="badge bg-success-subtle text-success border border-success px-3">
                                                <i class="bi bi-check-circle me-1"></i> {{ ucfirst($b->status) }}
                                            </span>
                                        @else
                                            <span class="badge bg-warning-subtle text-warning border border-warning px-3 text-dark">
                                                <i class="bi bi-clock me-1"></i> {{ ucfirst($b->status) }}
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-5">
                                        <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                        Belum ada aktivitas booking hari ini.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>