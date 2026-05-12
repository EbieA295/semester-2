@extends('layouts.dashboard')

@section('title', 'Laporan Keuangan')
@section('page_title', 'Ringkasan Transaksi & Keuangan')

@section('content')
<!-- Ringkasan Kartu -->
<div class="row g-4 mb-4">
    <div class="col-md-6 col-lg-4">
        <div class="card border-0 rounded-4 shadow-sm p-4 h-100 position-relative overflow-hidden group hover-shadow bg-orange text-white" style="background: linear-gradient(135deg, var(--primary-orange), var(--secondary-orange));">
            <div class="position-absolute top-0 end-0 p-3 opacity-25 transition-all group-hover-scale">
                <i data-lucide="wallet" size="100"></i>
            </div>
            <div class="position-relative z-1">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="bg-white bg-opacity-25 rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 45px; height: 45px;">
                        <i data-lucide="dollar-sign" class="text-white" size="20"></i>
                    </div>
                    <div class="text-white text-opacity-75 small fw-bold text-uppercase" style="letter-spacing: 1px;">Total Pemasukan</div>
                </div>
                <h2 class="fw-800 mb-0">Rp {{ number_format($totalPemasukan ?? 0, 0, ',', '.') }}</h2>
                <div class="small text-white text-opacity-75 mt-2">Seluruh transaksi lunas.</div>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 col-lg-4">
        <div class="card border-0 rounded-4 shadow-sm p-4 h-100 position-relative overflow-hidden group hover-shadow" style="background: linear-gradient(135deg, #ECFDF5 0%, #ffffff 100%);">
            <div class="position-absolute top-0 end-0 p-3 opacity-25 transition-all group-hover-scale">
                <i data-lucide="file-check-2" size="80" class="text-success"></i>
            </div>
            <div class="position-relative z-1">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="bg-white rounded-circle d-flex align-items-center justify-content-center shadow-sm border" style="width: 45px; height: 45px;">
                        <i data-lucide="list-checks" class="text-success" size="20"></i>
                    </div>
                    <div class="text-muted small fw-bold text-uppercase" style="letter-spacing: 1px;">Transaksi Sukses</div>
                </div>
                <h2 class="fw-800 mb-0 text-dark">{{ count($transaksiSelesai ?? []) }} <span class="fs-6 text-muted fw-normal">Booking</span></h2>
            </div>
        </div>
    </div>
    
    <div class="col-md-12 col-lg-4 d-flex flex-column gap-3">
        <button class="btn btn-orange w-100 flex-grow-1 rounded-4 fw-bold shadow-sm d-flex justify-content-center align-items-center gap-2 hover-shadow">
            <i data-lucide="printer" size="20"></i> Cetak Laporan (PDF)
        </button>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-light w-100 flex-grow-1 rounded-4 fw-bold shadow-sm d-flex justify-content-center align-items-center gap-2 border hover-shadow text-dark text-decoration-none">
            <i data-lucide="arrow-left" size="20"></i> Kembali ke Dashboard
        </a>
    </div>
</div>

<div class="card border-0 rounded-4 shadow-sm bg-white overflow-hidden mb-4">
    <div class="p-4 border-bottom d-flex justify-content-between align-items-center bg-light bg-opacity-50">
        <h5 class="fw-bold mb-0 text-dark d-flex align-items-center gap-2">
            <i data-lucide="file-spreadsheet" class="text-primary"></i> Rincian Transaksi
        </h5>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th class="ps-4">Tanggal Transaksi</th>
                    <th>Nama Penyewa</th>
                    <th>Unit</th>
                    <th>Status Pembayaran</th>
                    <th class="text-end pe-4">Nominal (Rp)</th>
                </tr>
            </thead>
            <tbody class="border-top-0">
                @forelse($transaksiSelesai ?? [] as $t)
                <tr>
                    <td class="ps-4">
                        <div class="fw-bold text-dark">{{ \Carbon\Carbon::parse($t->updated_at)->format('d F Y') }}</div>
                        <div class="extra-small text-muted">{{ \Carbon\Carbon::parse($t->updated_at)->format('H:i') }} WIB</div>
                    </td>
                    <td>
                        <div class="fw-bold text-dark">{{ $t->nama_penyewa }}</div>
                    </td>
                    <td>
                        <span class="badge bg-light text-dark border rounded-pill px-3 py-1 shadow-sm">
                            <i data-lucide="home" size="12" class="me-1 text-orange"></i> Unit {{ $t->unit_id }}
                        </span>
                    </td>
                    <td>
                        <span class="badge bg-success rounded-pill px-3 py-1 shadow-sm d-inline-flex align-items-center gap-1">
                            <i data-lucide="check-circle" size="12"></i> Paid
                        </span>
                    </td>
                    <td class="text-end pe-4 fw-bold text-success fs-5">
                        +{{ number_format($t->total_harga, 0, ',', '.') }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-5 text-muted">
                        <i data-lucide="wallet" size="48" class="opacity-25 mb-3 d-block mx-auto"></i>
                        <h5 class="fw-bold text-dark">Belum Ada Transaksi Masuk</h5>
                        <p class="mb-0">Saat ini belum ada data pemasukan atau pembayaran yang lunas.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
