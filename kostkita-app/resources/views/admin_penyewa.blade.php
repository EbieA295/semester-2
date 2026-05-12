@extends('layouts.dashboard')

@section('title', 'Kelola Penyewa')
@section('page_title', 'Data Penyewa Aktif')

@section('content')
<div class="card border-0 rounded-4 shadow-sm bg-white overflow-hidden mb-4">
    <div class="p-4 border-bottom d-flex justify-content-between align-items-center bg-light bg-opacity-50">
        <h5 class="fw-bold mb-0 text-dark d-flex align-items-center gap-2">
            <i data-lucide="users" class="text-orange"></i> Daftar Penghuni Kost
        </h5>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-light btn-sm rounded-pill px-3 fw-bold shadow-sm d-flex align-items-center gap-1 border">
            <i data-lucide="arrow-left" size="16"></i> Kembali
        </a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th class="ps-4">No</th>
                    <th>ID Kamar</th>
                    <th>Nama Penyewa</th>
                    <th>Kontak / HP</th>
                    <th>Tanggal Masuk</th>
                    <th>Status Pembayaran</th>
                </tr>
            </thead>
            <tbody class="border-top-0">
                @forelse($penyewaAktif ?? [] as $index => $p)
                <tr>
                    <td class="ps-4 fw-bold text-muted">{{ $index + 1 }}</td>
                    <td>
                        <span class="badge bg-soft-orange text-orange rounded-pill px-3 py-2 shadow-sm border border-orange">
                            <i data-lucide="key" size="12" class="me-1"></i> Unit {{ $p->unit_id }}
                        </span>
                    </td>
                    <td>
                        <div class="fw-bold text-dark fs-6">{{ $p->nama_penyewa }}</div>
                    </td>
                    <td>
                        <div class="small fw-medium text-muted d-flex align-items-center gap-1">
                            <i data-lucide="phone" size="14" class="text-primary"></i> {{ $p->no_hp }}
                        </div>
                    </td>
                    <td>
                        <div class="fw-medium text-dark">{{ \Carbon\Carbon::parse($p->tgl_masuk)->format('d F Y') }}</div>
                        <div class="extra-small text-muted">Durasi: Sedang Aktif</div>
                    </td>
                    <td>
                        <span class="badge bg-success rounded-pill px-3 py-1 shadow-sm d-inline-flex align-items-center gap-1">
                            <i data-lucide="check-circle" size="14"></i> Lunas
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-5 text-muted">
                        <i data-lucide="users" size="48" class="opacity-25 mb-3 d-block mx-auto"></i>
                        <h5 class="fw-bold text-dark">Belum Ada Penyewa</h5>
                        <p class="mb-0">Saat ini belum ada data penyewa aktif di KostKita.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
