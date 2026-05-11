@extends('layouts.dashboard')

@section('title', 'Owner Dashboard')
@section('page_title', 'Dashboard Pemilik Kost')

@section('content')
<div class="row g-4 mb-5">
    <div class="col-md-4">
        <div class="card-stats">
            <div class="stat-icon bg-soft-orange text-orange">
                <i data-lucide="home"></i>
            </div>
            <div class="text-muted small fw-bold mb-1 text-uppercase">Total Properti</div>
            <h3 class="fw-800 mb-0">5 Units</h3>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card-stats">
            <div class="stat-icon bg-success bg-opacity-10 text-success">
                <i data-lucide="users"></i>
            </div>
            <div class="text-muted small fw-bold mb-1 text-uppercase">Penyewa Aktif</div>
            <h3 class="fw-800 mb-0">3 Orang</h3>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card-stats">
            <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                <i data-lucide="trending-up"></i>
            </div>
            <div class="text-muted small fw-bold mb-1 text-uppercase">Estimasi Pendapatan</div>
            <h3 class="fw-800 mb-0">Rp 4.5M</h3>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card border-0 rounded-4 shadow-sm bg-white p-4 mb-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h6 class="fw-bold mb-0">Unit Kost Saya</h6>
                <button class="btn btn-orange btn-sm rounded-pill px-3">+ Tambah Unit</button>
            </div>
            <div class="table-responsive">
                <table class="table table-premium mb-0">
                    <thead>
                        <tr>
                            <th>Unit</th>
                            <th>Tipe</th>
                            <th>Harga</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="fw-bold">A101</td>
                            <td>Putra</td>
                            <td>Rp 1.500.000</td>
                            <td><span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2">Tersedia</span></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">A102</td>
                            <td>Putra</td>
                            <td>Rp 1.500.000</td>
                            <td><span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3 py-2">Terisi</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card border-0 rounded-4 shadow-sm bg-white p-4">
            <h6 class="fw-bold mb-4">Aktivitas Terbaru</h6>
            <div class="d-grid gap-3">
                <div class="d-flex gap-3">
                    <div class="bg-light p-2 rounded-circle text-muted align-self-start"><i data-lucide="info" size="14"></i></div>
                    <div>
                        <div class="small fw-bold">Pembayaran A102 Berhasil</div>
                        <div class="extra-small text-muted">Hari ini, 09:00</div>
                    </div>
                </div>
                <div class="d-flex gap-3">
                    <div class="bg-light p-2 rounded-circle text-muted align-self-start"><i data-lucide="user" size="14"></i></div>
                    <div>
                        <div class="small fw-bold">Calon Penyewa bertanya tentang A101</div>
                        <div class="extra-small text-muted">Kemarin, 18:30</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
