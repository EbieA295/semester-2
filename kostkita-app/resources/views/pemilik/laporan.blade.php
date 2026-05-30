@extends('layouts.dashboard')

@section('title', 'Laporan Keuangan')
@section('page_title', 'Laporan Keuangan & Analisis')

@section('content')
<!-- Filter Section -->
<div class="card border-0 rounded-4 shadow-sm p-4 mb-4 bg-white position-relative overflow-hidden">
    <div class="position-absolute top-0 end-0 p-4 opacity-10" style="pointer-events: none;">
        <i data-lucide="filter" size="80"></i>
    </div>
    <div class="position-relative z-1">
        <h6 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
            <i data-lucide="sliders-horizontal" class="text-orange" size="18"></i> Filter Periode Laporan
        </h6>
        <form action="{{ route('pemilik.laporan') }}" method="GET" class="row g-3 align-items-end">
            <div class="col-md-3">
                <label class="small fw-bold text-muted text-uppercase mb-2" style="letter-spacing: 1px;">Mode Periode</label>
                <select name="mode" class="form-select border-0 bg-light rounded-4 py-2" id="filterMode" onchange="toggleFilterFields()">
                    <option value="bulanan" {{ ($filterMode ?? 'bulanan') == 'bulanan' ? 'selected' : '' }}>Bulanan</option>
                    <option value="tahunan" {{ ($filterMode ?? '') == 'tahunan' ? 'selected' : '' }}>Tahunan</option>
                    <option value="semua" {{ ($filterMode ?? '') == 'semua' ? 'selected' : '' }}>Semua Periode</option>
                </select>
            </div>
            <div class="col-md-3" id="fieldBulan">
                <label class="small fw-bold text-muted text-uppercase mb-2" style="letter-spacing: 1px;">Bulan</label>
                <select name="bulan" class="form-select border-0 bg-light rounded-4 py-2">
                    @foreach(range(1,12) as $m)
                        <option value="{{ $m }}" {{ ($bulan ?? now()->month) == $m ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create(null, $m)->translatedFormat('F') }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3" id="fieldTahun">
                <label class="small fw-bold text-muted text-uppercase mb-2" style="letter-spacing: 1px;">Tahun</label>
                <select name="tahun" class="form-select border-0 bg-light rounded-4 py-2">
                    @for($y = now()->year; $y >= now()->year - 5; $y--)
                        <option value="{{ $y }}" {{ ($tahun ?? now()->year) == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endfor
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-orange w-100 py-2 rounded-4 fw-bold shadow-sm d-flex justify-content-center align-items-center gap-2">
                    <i data-lucide="search" size="16"></i> Terapkan Filter
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Ringkasan Kartu -->
<div class="row g-4 mb-4">
    <div class="col-md-6 col-lg-3">
        <div class="card border-0 rounded-4 shadow-sm p-4 h-100 position-relative overflow-hidden group hover-shadow" style="background: linear-gradient(135deg, var(--primary-orange), var(--secondary-orange));">
            <div class="position-absolute top-0 end-0 p-3 opacity-25 transition-all group-hover-scale">
                <i data-lucide="wallet" size="80" class="text-white"></i>
            </div>
            <div class="position-relative z-1">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="bg-white bg-opacity-25 rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 45px; height: 45px;">
                        <i data-lucide="dollar-sign" class="text-white" size="20"></i>
                    </div>
                    <div class="text-white text-opacity-75 small fw-bold text-uppercase" style="letter-spacing: 1px;">Total Pemasukan</div>
                </div>
                <h2 class="fw-800 mb-0 text-white">Rp {{ number_format($totalPemasukan ?? 0, 0, ',', '.') }}</h2>
                <div class="small text-white text-opacity-75 mt-2">
                    @if($filterMode == 'bulanan')
                        Periode: {{ \Carbon\Carbon::create($tahun, $bulan)->translatedFormat('F Y') }}
                    @elseif($filterMode == 'tahunan')
                        Periode: Tahun {{ $tahun }}
                    @else
                        Seluruh Periode
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 col-lg-3">
        <div class="card border-0 rounded-4 shadow-sm p-4 h-100 position-relative overflow-hidden group hover-shadow card-gradient-success">
            <div class="position-absolute top-0 end-0 p-3 opacity-25 transition-all group-hover-scale">
                <i data-lucide="file-check-2" size="80" class="text-success"></i>
            </div>
            <div class="position-relative z-1">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="bg-white rounded-circle d-flex align-items-center justify-content-center shadow-sm border" style="width: 45px; height: 45px;">
                        <i data-lucide="list-checks" class="text-success" size="20"></i>
                    </div>
                    <div class="text-muted small fw-bold text-uppercase" style="letter-spacing: 1px;">Transaksi Lunas</div>
                </div>
                <h2 class="fw-800 mb-0 text-dark">{{ count($transaksiSelesai ?? []) }} <span class="fs-6 text-muted fw-normal">Booking</span></h2>
                <div class="small text-muted mt-2">Total keseluruhan: {{ $totalTransaksiAll ?? 0 }}</div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="card border-0 rounded-4 shadow-sm p-4 h-100 position-relative overflow-hidden group hover-shadow card-gradient-info">
            <div class="position-absolute top-0 end-0 p-3 opacity-25 transition-all group-hover-scale">
                <i data-lucide="trending-up" size="80" class="text-primary"></i>
            </div>
            <div class="position-relative z-1">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="bg-white rounded-circle d-flex align-items-center justify-content-center shadow-sm border" style="width: 45px; height: 45px;">
                        <i data-lucide="bar-chart-3" class="text-primary" size="20"></i>
                    </div>
                    <div class="text-muted small fw-bold text-uppercase" style="letter-spacing: 1px;">Rata-rata/Bulan</div>
                </div>
                <h2 class="fw-800 mb-0 text-dark">Rp {{ number_format($avgPerMonth ?? 0, 0, ',', '.') }}</h2>
                <div class="small text-muted mt-2">12 bulan terakhir</div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="card border-0 rounded-4 shadow-sm p-4 h-100 position-relative overflow-hidden group hover-shadow card-gradient-danger">
            <div class="position-absolute top-0 end-0 p-3 opacity-25 transition-all group-hover-scale">
                <i data-lucide="home" size="80" class="text-danger"></i>
            </div>
            <div class="position-relative z-1">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="bg-white rounded-circle d-flex align-items-center justify-content-center shadow-sm border" style="width: 45px; height: 45px;">
                        <i data-lucide="building-2" class="text-danger" size="20"></i>
                    </div>
                    <div class="text-muted small fw-bold text-uppercase" style="letter-spacing: 1px;">Okupansi</div>
                </div>
                <h2 class="fw-800 mb-0 text-dark">{{ $occupancyRate ?? 0 }}%</h2>
                <div class="small text-muted mt-2">Tingkat hunian saat ini</div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <!-- Chart Pemasukan Bulanan -->
    <div class="col-lg-8">
        <div class="card border-0 rounded-4 shadow-sm bg-white overflow-hidden h-100">
            <div class="p-4 border-bottom d-flex justify-content-between align-items-center bg-light bg-opacity-50">
                <h5 class="fw-bold mb-0 text-dark d-flex align-items-center gap-2">
                    <i data-lucide="bar-chart-2" class="text-orange"></i> Grafik Pemasukan 12 Bulan Terakhir
                </h5>
            </div>
            <div class="p-4">
                <canvas id="chartPemasukan" height="300"></canvas>
            </div>
        </div>
    </div>

    <!-- Pemasukan per Tipe Kamar + Aksi -->
    <div class="col-lg-4">
        <div class="card border-0 rounded-4 shadow-sm bg-white overflow-hidden mb-4">
            <div class="p-4 border-bottom d-flex justify-content-between align-items-center bg-light bg-opacity-50">
                <h5 class="fw-bold mb-0 text-dark d-flex align-items-center gap-2">
                    <i data-lucide="pie-chart" class="text-orange"></i> Per Tipe Kamar
                </h5>
            </div>
            <div class="p-4">
                <canvas id="chartTipe" height="200"></canvas>
                <div class="mt-3">
                    @foreach($pemasukanPerTipe ?? [] as $pt)
                    <div class="d-flex justify-content-between align-items-center py-2 {{ !$loop->last ? 'border-bottom' : '' }}">
                        <div class="d-flex align-items-center gap-2">
                            <span class="rounded-circle d-inline-block" style="width: 10px; height: 10px; background: {{ $loop->index == 0 ? '#FF6B00' : ($loop->index == 1 ? '#3B82F6' : '#10B981') }};"></span>
                            <span class="small fw-bold text-dark">{{ $pt['tipe'] }}</span>
                        </div>
                        <div class="text-end">
                            <div class="small fw-bold text-dark">Rp {{ number_format($pt['total'], 0, ',', '.') }}</div>
                            <div class="extra-small text-muted">{{ $pt['count'] }} transaksi</div>
                        </div>
                    </div>
                    @endforeach
                    @if(count($pemasukanPerTipe ?? []) == 0)
                    <div class="text-center py-3 text-muted">
                        <i data-lucide="pie-chart" size="32" class="opacity-25 mb-2 d-block mx-auto"></i>
                        <div class="small">Belum ada data per tipe</div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Aksi Cepat -->
        <div class="d-flex flex-column gap-3">
            <a href="{{ route('pemilik.laporan.cetak', ['mode' => $filterMode, 'bulan' => $bulan, 'tahun' => $tahun]) }}" target="_blank" class="btn btn-orange py-3 rounded-4 fw-bold shadow-sm d-flex justify-content-center align-items-center gap-2 hover-shadow text-decoration-none">
                <i data-lucide="printer" size="20"></i> Cetak Laporan (PDF)
            </a>
            <a href="{{ route('pemilik.dashboard') }}" class="btn btn-light border py-3 rounded-4 fw-bold shadow-sm d-flex justify-content-center align-items-center gap-2 hover-shadow text-dark text-decoration-none">
                <i data-lucide="arrow-left" size="20"></i> Kembali ke Dashboard
            </a>
        </div>

        <!-- Ringkasan Keseluruhan -->
        <div class="card border-0 rounded-4 shadow-sm bg-white p-4 mt-3">
            <h6 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
                <i data-lucide="calculator" class="text-orange" size="18"></i> Total Keseluruhan
            </h6>
            <div class="bg-soft-orange p-3 rounded-4 text-center mb-2">
                <div class="extra-small text-muted fw-bold text-uppercase" style="letter-spacing: 1px;">Akumulasi Pemasukan</div>
                <h4 class="fw-800 text-orange mb-0 mt-1">Rp {{ number_format($totalPemasukanAll ?? 0, 0, ',', '.') }}</h4>
            </div>
            <div class="bg-light p-3 rounded-4 text-center">
                <div class="extra-small text-muted fw-bold text-uppercase" style="letter-spacing: 1px;">Total Transaksi Lunas</div>
                <h4 class="fw-800 text-dark mb-0 mt-1">{{ $totalTransaksiAll ?? 0 }} <span class="fs-6 text-muted fw-normal">Booking</span></h4>
            </div>
        </div>
    </div>
</div>

<!-- Tabel Rincian Transaksi -->
<div class="card border-0 rounded-4 shadow-sm bg-white overflow-hidden mb-4">
    <div class="p-4 border-bottom d-flex justify-content-between align-items-center bg-light bg-opacity-50">
        <h5 class="fw-bold mb-0 text-dark d-flex align-items-center gap-2">
            <i data-lucide="file-spreadsheet" class="text-primary"></i> Rincian Transaksi
        </h5>
        <span class="badge bg-soft-orange text-orange rounded-pill px-3 py-2 shadow-sm">{{ count($transaksiSelesai ?? []) }} Data</span>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th class="ps-4">No</th>
                    <th>Tanggal Transaksi</th>
                    <th>Nama Penyewa</th>
                    <th>Unit</th>
                    <th>Tipe</th>
                    <th>Status</th>
                    <th class="text-end pe-4">Nominal (Rp)</th>
                </tr>
            </thead>
            <tbody class="border-top-0">
                @forelse($transaksiSelesai ?? [] as $index => $t)
                <tr>
                    <td class="ps-4 fw-bold text-muted">{{ $index + 1 }}</td>
                    <td>
                        <div class="fw-bold text-dark">{{ \Carbon\Carbon::parse($t->updated_at)->format('d F Y') }}</div>
                        <div class="extra-small text-muted">{{ \Carbon\Carbon::parse($t->updated_at)->format('H:i') }} WIB</div>
                    </td>
                    <td>
                        <div class="fw-bold text-dark">{{ $t->nama_penyewa }}</div>
                        <div class="extra-small text-muted d-flex align-items-center gap-1"><i data-lucide="phone" size="10"></i> {{ $t->no_hp }}</div>
                    </td>
                    <td>
                        <span class="badge bg-light text-dark border rounded-pill px-3 py-1 shadow-sm">
                            <i data-lucide="home" size="12" class="me-1 text-orange"></i> {{ $t->unit_id }}
                        </span>
                    </td>
                    <td>
                        <span class="badge bg-light text-dark border rounded-pill px-2 py-1">
                            {{ $t->unit ? $t->unit->tipe : '-' }}
                        </span>
                    </td>
                    <td>
                        <span class="badge bg-success rounded-pill px-3 py-1 shadow-sm d-inline-flex align-items-center gap-1">
                            <i data-lucide="check-circle" size="12"></i> Lunas
                        </span>
                    </td>
                    <td class="text-end pe-4 fw-bold text-success fs-5">
                        +{{ number_format($t->total_harga, 0, ',', '.') }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-5 text-muted">
                        <i data-lucide="wallet" size="48" class="opacity-25 mb-3 d-block mx-auto"></i>
                        <h5 class="fw-bold text-dark">Belum Ada Transaksi</h5>
                        <p class="mb-0 text-muted">Belum ada data pemasukan pada periode yang dipilih.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
            @if(count($transaksiSelesai ?? []) > 0)
            <tfoot class="table-light">
                <tr>
                    <td colspan="6" class="ps-4 fw-800 text-dark text-end">TOTAL PEMASUKAN</td>
                    <td class="text-end pe-4 fw-800 text-orange fs-5">Rp {{ number_format($totalPemasukan ?? 0, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
            @endif
        </table>
    </div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

<script>
    // Toggle filter fields based on mode
    function toggleFilterFields() {
        const mode = document.getElementById('filterMode').value;
        const fieldBulan = document.getElementById('fieldBulan');
        const fieldTahun = document.getElementById('fieldTahun');
        
        if (mode === 'semua') {
            fieldBulan.style.display = 'none';
            fieldTahun.style.display = 'none';
        } else if (mode === 'tahunan') {
            fieldBulan.style.display = 'none';
            fieldTahun.style.display = 'block';
        } else {
            fieldBulan.style.display = 'block';
            fieldTahun.style.display = 'block';
        }
    }
    toggleFilterFields();

    // Chart Pemasukan Bulanan
    const chartDataRaw = @json($chartData ?? []);
    const isDarkMode = document.body.classList.contains('dark-mode');
    const textColor = isDarkMode ? '#F8FAFC' : '#0F172A';
    const gridColor = isDarkMode ? 'rgba(255,255,255,0.1)' : 'rgba(0,0,0,0.06)';
    
    const ctx1 = document.getElementById('chartPemasukan');
    if (ctx1) {
        new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: chartDataRaw.map(d => d.label),
                datasets: [{
                    label: 'Pemasukan (Rp)',
                    data: chartDataRaw.map(d => d.total),
                    backgroundColor: chartDataRaw.map((d, i) => i === chartDataRaw.length - 1 ? 'rgba(255, 107, 0, 0.9)' : 'rgba(255, 107, 0, 0.3)'),
                    borderColor: 'rgba(255, 107, 0, 1)',
                    borderWidth: 1,
                    borderRadius: 8,
                    borderSkipped: false,
                }, {
                    label: 'Jumlah Transaksi',
                    data: chartDataRaw.map(d => d.count),
                    type: 'line',
                    borderColor: '#3B82F6',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 4,
                    pointBackgroundColor: '#3B82F6',
                    yAxisID: 'y1',
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: { intersect: false, mode: 'index' },
                plugins: {
                    legend: {
                        labels: { color: textColor, font: { family: "'Plus Jakarta Sans', sans-serif", weight: '600' }, usePointStyle: true }
                    },
                    tooltip: {
                        backgroundColor: isDarkMode ? '#1E293B' : '#fff',
                        titleColor: isDarkMode ? '#F8FAFC' : '#0F172A',
                        bodyColor: isDarkMode ? '#94A3B8' : '#64748B',
                        borderColor: isDarkMode ? '#334155' : '#E2E8F0',
                        borderWidth: 1,
                        cornerRadius: 12,
                        padding: 12,
                        callbacks: {
                            label: function(context) {
                                if (context.datasetIndex === 0) {
                                    return 'Pemasukan: Rp ' + context.parsed.y.toLocaleString('id-ID');
                                }
                                return 'Transaksi: ' + context.parsed.y;
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        ticks: { color: textColor, font: { size: 10, family: "'Plus Jakarta Sans'" } },
                        grid: { display: false }
                    },
                    y: {
                        ticks: {
                            color: textColor,
                            font: { size: 10 },
                            callback: function(value) { return 'Rp ' + (value / 1000000).toFixed(1) + 'jt'; }
                        },
                        grid: { color: gridColor }
                    },
                    y1: {
                        position: 'right',
                        ticks: { color: '#3B82F6', font: { size: 10 } },
                        grid: { display: false },
                    }
                }
            }
        });
    }

    // Chart Tipe Kamar (Doughnut)
    const tipeData = @json($pemasukanPerTipe ?? []);
    const tipeColors = ['#FF6B00', '#3B82F6', '#10B981', '#F59E0B', '#EF4444'];
    const ctx2 = document.getElementById('chartTipe');
    if (ctx2 && tipeData.length > 0) {
        new Chart(ctx2, {
            type: 'doughnut',
            data: {
                labels: tipeData.map(d => d.tipe),
                datasets: [{
                    data: tipeData.map(d => d.total),
                    backgroundColor: tipeColors.slice(0, tipeData.length),
                    borderWidth: 0,
                    hoverOffset: 8,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '65%',
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: isDarkMode ? '#1E293B' : '#fff',
                        titleColor: isDarkMode ? '#F8FAFC' : '#0F172A',
                        bodyColor: isDarkMode ? '#94A3B8' : '#64748B',
                        borderColor: isDarkMode ? '#334155' : '#E2E8F0',
                        borderWidth: 1,
                        cornerRadius: 12,
                        padding: 12,
                        callbacks: {
                            label: function(context) {
                                return context.label + ': Rp ' + context.parsed.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });
    }
</script>

<style>
    .hover-shadow { transition: all 0.3s ease; }
    .hover-shadow:hover { box-shadow: 0 15px 30px rgba(0,0,0,0.08) !important; transform: translateY(-3px); }
    .group-hover-scale { transition: transform 0.5s ease; }
    .group:hover .group-hover-scale { transform: scale(1.2) rotate(-5deg); }
    .hover-scale { transition: transform 0.2s; }
    .hover-scale:hover { transform: scale(1.15); z-index: 10; position: relative; }
    
    .table-hover tbody tr { transition: background-color 0.2s; }
    .table-hover tbody tr:hover { background-color: rgba(0,0,0,0.02); }

    #chartPemasukan { min-height: 300px; }
    #chartTipe { min-height: 200px; }
</style>
@endsection
