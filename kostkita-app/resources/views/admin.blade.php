@extends('layouts.dashboard')

@section('title', 'Admin Dashboard')
@section('page_title', 'Dashboard Ringkasan')

@section('content')
<!-- Header Stats -->
<div class="row g-4 mb-5">
    <div class="col-md-3">
        <div class="card border-0 rounded-4 shadow-sm p-4 h-100 position-relative overflow-hidden group hover-shadow card-gradient-warning">
            <div class="position-absolute top-0 end-0 p-3 opacity-25 transition-all group-hover-scale">
                <i data-lucide="home" size="80" class="text-orange"></i>
            </div>
            <div class="position-relative z-1">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="bg-white rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 45px; height: 45px;">
                        <i data-lucide="home" class="text-orange" size="20"></i>
                    </div>
                    <div class="text-muted small fw-bold text-uppercase" style="letter-spacing: 1px;">Total Unit</div>
                </div>
                <h2 class="fw-800 mb-0 text-dark">{{ $totalUnits ?? 0 }} <span class="fs-6 text-muted fw-normal">Kamar</span></h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 rounded-4 shadow-sm p-4 h-100 position-relative overflow-hidden group hover-shadow card-gradient-success">
            <div class="position-absolute top-0 end-0 p-3 opacity-25 transition-all group-hover-scale">
                <i data-lucide="check-circle" size="80" class="text-success"></i>
            </div>
            <div class="position-relative z-1">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="bg-white rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 45px; height: 45px;">
                        <i data-lucide="check-circle" class="text-success" size="20"></i>
                    </div>
                    <div class="text-muted small fw-bold text-uppercase" style="letter-spacing: 1px;">Tersedia</div>
                </div>
                <h2 class="fw-800 mb-0 text-dark">{{ $availableUnits ?? 0 }} <span class="fs-6 text-muted fw-normal">Kosong</span></h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 rounded-4 shadow-sm p-4 h-100 position-relative overflow-hidden group hover-shadow card-gradient-danger">
            <div class="position-absolute top-0 end-0 p-3 opacity-25 transition-all group-hover-scale">
                <i data-lucide="user-check" size="80" class="text-danger"></i>
            </div>
            <div class="position-relative z-1">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="bg-white rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 45px; height: 45px;">
                        <i data-lucide="user-check" class="text-danger" size="20"></i>
                    </div>
                    <div class="text-muted small fw-bold text-uppercase" style="letter-spacing: 1px;">Terisi</div>
                </div>
                <h2 class="fw-800 mb-0 text-dark">{{ $occupiedUnits ?? 0 }} <span class="fs-6 text-muted fw-normal">Penyewa</span></h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 rounded-4 shadow-sm p-4 h-100 position-relative overflow-hidden group hover-shadow card-gradient-info">
            <div class="position-absolute top-0 end-0 p-3 opacity-25 transition-all group-hover-scale">
                <i data-lucide="clock" size="80" class="text-primary"></i>
            </div>
            <div class="position-relative z-1">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="bg-white rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 45px; height: 45px;">
                        <i data-lucide="clock" class="text-primary" size="20"></i>
                    </div>
                    <div class="text-muted small fw-bold text-uppercase" style="letter-spacing: 1px;">Antrean</div>
                </div>
                <h2 class="fw-800 mb-0 text-dark">{{ $pendingBookings ?? 0 }} <span class="fs-6 text-muted fw-normal">Request</span></h2>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <!-- Antrean Booking -->
        <div class="card border-0 rounded-4 shadow-sm bg-white overflow-hidden mb-5">
            <div class="p-4 border-bottom d-flex justify-content-between align-items-center bg-light bg-opacity-50">
                <h5 class="fw-bold mb-0 text-dark d-flex align-items-center gap-2">
                    <i data-lucide="bell" class="text-orange"></i> Antrean Booking
                </h5>
                <span class="badge bg-soft-orange text-orange rounded-pill px-3 py-2 shadow-sm">{{ count($bookings) }} Menunggu</span>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Unit</th>
                            <th>Penyewa</th>
                            <th>Tgl Masuk</th>
                            <th>Pembayaran</th>
                            <th class="text-end pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        @forelse($bookings ?? [] as $b)
                        <tr>
                            <td class="ps-4 fw-bold text-orange">#{{ $b->unit_id }}</td>
                            <td>
                                <div class="fw-bold text-dark">{{ $b->nama_penyewa }}</div>
                                <div class="extra-small text-muted d-flex align-items-center gap-1"><i data-lucide="phone" size="10"></i> {{ $b->no_hp }}</div>
                            </td>
                            <td>
                                <div class="small fw-medium">{{ \Carbon\Carbon::parse($b->tgl_masuk)->format('d M Y') }}</div>
                            </td>
                            <td>
                                @if($b->payment_proof)
                                    <button onclick="lihatBukti('{{ asset('storage/'.$b->payment_proof) }}', '{{ $b->id }}', '{{ $b->payment_status }}')" class="btn btn-soft-orange btn-sm rounded-pill py-1 px-3 d-flex align-items-center gap-1 shadow-sm">
                                        <i data-lucide="image" size="14"></i> Lihat Bukti
                                    </button>
                                @else
                                    <span class="badge bg-light text-muted border rounded-pill px-2">Belum Bayar</span>
                                @endif
                            </td>
                            <td class="text-end pe-4">
                                @if($b->status == 'Pending')
                                    <form action="{{ route('admin.konfirmasiBooking', $b->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-orange btn-sm rounded-pill px-3 fw-bold shadow-sm">Setujui</button>
                                    </form>
                                @elseif($b->status == 'Waiting for Payment')
                                    <span class="badge bg-warning text-dark rounded-pill px-3 shadow-sm">Menunggu Bayar</span>
                                @elseif($b->status == 'Confirmed')
                                    <span class="badge bg-success rounded-pill px-3 shadow-sm"><i data-lucide="check" size="12" class="me-1"></i>Selesai</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i data-lucide="check-circle" size="48" class="opacity-25 mb-3"></i>
                                <div>Tidak ada antrean booking saat ini.</div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Daftar Unit Kost -->
        <div class="card border-0 rounded-4 shadow-sm bg-white overflow-hidden mb-4">
            <div class="p-4 border-bottom d-flex justify-content-between align-items-center bg-light bg-opacity-50">
                <h5 class="fw-bold mb-0 text-dark d-flex align-items-center gap-2">
                    <i data-lucide="grid" class="text-orange"></i> Daftar Unit Kost
                </h5>
                <button class="btn btn-orange btn-sm rounded-pill px-3 fw-bold shadow-sm d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#modalTambahUnit">
                    <i data-lucide="plus" size="16"></i> Tambah
                </button>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Unit</th>
                            <th>Tipe & Lokasi</th>
                            <th>Harga/Bln</th>
                            <th>Status</th>
                            <th class="text-end pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        @foreach($units ?? [] as $unit)
                        <tr>
                            <td class="ps-4 fw-bold text-dark fs-5">{{ $unit->id }}</td>
                            <td>
                                <div class="fw-bold text-dark">{{ $unit->tipe }}</div>
                                <div class="extra-small text-muted d-flex align-items-center gap-1"><i data-lucide="map-pin" size="10"></i> {{ $unit->lokasi }}</div>
                            </td>
                            <td class="fw-bold text-orange">Rp {{ number_format($unit->harga, 0, ',', '.') }}</td>
                            <td>
                                @php
                                    $bgClass = $unit->status == 'Tersedia' ? 'bg-success' : ($unit->status == 'Terisi' ? 'bg-danger' : 'bg-warning text-dark');
                                @endphp
                                <span class="badge {{ $bgClass }} rounded-pill px-3 py-1 shadow-sm">
                                    {{ $unit->status }}
                                </span>
                            </td>
                            <td class="text-end pe-4">
                                <button onclick="editUnit('{{ $unit->id }}', '{{ $unit->tipe }}', '{{ $unit->lokasi }}', '{{ $unit->harga }}', '{{ $unit->status }}')" class="btn btn-light btn-sm rounded-circle shadow-sm border me-1 transition-all hover-shadow" title="Edit"><i data-lucide="edit-2" size="14" class="text-primary"></i></button>
                                <button onclick="hapusUnit('{{ $unit->id }}')" class="btn btn-light btn-sm rounded-circle shadow-sm border transition-all hover-shadow" title="Hapus"><i data-lucide="trash-2" size="14" class="text-danger"></i></button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Sidebar Area -->
    <div class="col-lg-4">
        <div class="card border-0 rounded-4 shadow-sm bg-white p-4 mb-4">
            <h5 class="fw-bold mb-4 text-dark d-flex align-items-center gap-2">
                <i data-lucide="zap" class="text-orange"></i> Aksi Cepat
            </h5>
            <div class="d-grid gap-3">
                <button class="btn btn-orange py-3 rounded-4 fw-bold shadow-sm d-flex justify-content-center align-items-center gap-2 transition-all hover-shadow" data-bs-toggle="modal" data-bs-target="#modalTambahUnit">
                    <i data-lucide="plus-circle" size="20"></i> Tambah Unit Baru
                </button>
                <a href="{{ route('admin.laporan') }}" class="btn btn-light border py-3 rounded-4 fw-bold d-flex justify-content-center align-items-center gap-2 transition-all hover-shadow text-dark text-decoration-none">
                    <i data-lucide="file-text" size="20" class="text-primary"></i> Laporan Keuangan
                </a>
                <a href="{{ route('admin.penyewa') }}" class="btn btn-light border py-3 rounded-4 fw-bold d-flex justify-content-center align-items-center gap-2 transition-all hover-shadow text-dark text-decoration-none">
                    <i data-lucide="users" size="20" class="text-success"></i> Kelola Penyewa
                </a>
            </div>
        </div>

        <div class="card border-0 rounded-4 shadow-sm bg-white p-4 overflow-hidden position-relative">
            <div class="position-absolute top-0 end-0 p-3 opacity-10" style="pointer-events: none;">
                <i data-lucide="map" size="100"></i>
            </div>
            <h5 class="fw-bold mb-4 text-dark d-flex align-items-center gap-2 position-relative z-1">
                <i data-lucide="map-pin" class="text-orange"></i> Denah Unit
            </h5>
            <div class="d-flex flex-wrap gap-2 position-relative z-1">
                @foreach($units ?? [] as $unit)
                @php
                    $color = $unit->status == 'Tersedia' ? 'var(--primary-orange)' : ($unit->status == 'Terisi' ? '#EF4444' : '#F59E0B');
                    $shadowColor = $unit->status == 'Tersedia' ? 'rgba(255, 107, 0, 0.4)' : ($unit->status == 'Terisi' ? 'rgba(239, 68, 68, 0.4)' : 'rgba(245, 158, 11, 0.4)');
                @endphp
                <div class="rounded-3 p-2 text-center text-white transition-all hover-scale" style="background: {{ $color }}; box-shadow: 0 4px 10px {{ $shadowColor }}; min-width: 55px; font-size: 12px; font-weight: 800; cursor: pointer;" title="{{ $unit->id }} - {{ $unit->status }}">
                    {{ $unit->id }}
                </div>
                @endforeach
            </div>
            
            <div class="mt-4 pt-3 border-top position-relative z-1">
                <div class="d-flex justify-content-between small text-muted">
                    <div class="d-flex align-items-center gap-1"><span class="rounded-circle d-inline-block" style="width:10px;height:10px;background:var(--primary-orange);"></span> Tersedia</div>
                    <div class="d-flex align-items-center gap-1"><span class="rounded-circle bg-danger d-inline-block" style="width:10px;height:10px;"></span> Terisi</div>
                    <div class="d-flex align-items-center gap-1"><span class="rounded-circle bg-warning d-inline-block" style="width:10px;height:10px;"></span> Dipesan</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Unit -->
<div class="modal fade" id="modalTambahUnit" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg p-2">
            <div class="modal-header border-0 pb-0 pt-4 px-4">
                <h4 class="fw-800 text-dark">Tambah Unit Baru</h4>
                <button type="button" class="btn-close bg-light rounded-circle p-2" data-bs-dismiss="modal"></button>
            </div>
            <form id="formTambahUnit" enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-muted text-uppercase" style="letter-spacing: 1px;">ID UNIT</label>
                        <input type="text" name="id" class="form-control form-control-lg border-0 bg-light rounded-4" placeholder="Contoh: A105" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-muted text-uppercase" style="letter-spacing: 1px;">TIPE KAMAR</label>
                        <select name="tipe" class="form-select form-select-lg border-0 bg-light rounded-4" required>
                            <option value="Hemat">Hemat</option>
                            <option value="Standar">Standar</option>
                            <option value="Premium">Premium</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-muted text-uppercase" style="letter-spacing: 1px;">LOKASI / LANTAI</label>
                        <input type="text" name="lokasi" class="form-control form-control-lg border-0 bg-light rounded-4" placeholder="Contoh: Lantai 1" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-muted text-uppercase" style="letter-spacing: 1px;">HARGA PER BULAN (Rp)</label>
                        <input type="number" name="harga" class="form-control form-control-lg border-0 bg-light rounded-4" placeholder="Contoh: 1500000" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label small fw-bold text-muted text-uppercase" style="letter-spacing: 1px;">STATUS</label>
                        <select name="status" class="form-select form-select-lg border-0 bg-light rounded-4" required>
                            <option value="Tersedia">Tersedia</option>
                            <option value="Terisi">Terisi</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="submit" class="btn btn-orange w-100 py-3 rounded-pill fw-bold shadow-sm" style="font-size: 1.1rem;">SIMPAN UNIT</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Unit -->
<div class="modal fade" id="modalEditUnit" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg p-2">
            <div class="modal-header border-0 pb-0 pt-4 px-4">
                <h4 class="fw-800 text-dark">Edit Unit Kost</h4>
                <button type="button" class="btn-close bg-light rounded-circle p-2" data-bs-dismiss="modal"></button>
            </div>
            <form id="formEditUnit">
                @csrf
                <div class="modal-body p-4">
                    <input type="hidden" id="edit_id_original">
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-muted text-uppercase" style="letter-spacing: 1px;">ID UNIT</label>
                        <input type="text" id="edit_id" class="form-control form-control-lg border-0 bg-light rounded-4 text-muted" disabled>
                    </div>
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-muted text-uppercase" style="letter-spacing: 1px;">TIPE KAMAR</label>
                        <select id="edit_tipe" name="tipe" class="form-select form-select-lg border-0 bg-light rounded-4" required>
                            <option value="Hemat">Hemat</option>
                            <option value="Standar">Standar</option>
                            <option value="Premium">Premium</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-muted text-uppercase" style="letter-spacing: 1px;">LOKASI / LANTAI</label>
                        <input type="text" id="edit_lokasi" name="lokasi" class="form-control form-control-lg border-0 bg-light rounded-4" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-muted text-uppercase" style="letter-spacing: 1px;">HARGA PER BULAN (Rp)</label>
                        <input type="number" id="edit_harga" name="harga" class="form-control form-control-lg border-0 bg-light rounded-4" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label small fw-bold text-muted text-uppercase" style="letter-spacing: 1px;">STATUS</label>
                        <select id="edit_status" name="status" class="form-select form-select-lg border-0 bg-light rounded-4" required>
                            <option value="Tersedia">Tersedia</option>
                            <option value="Terisi">Terisi</option>
                            <option value="Dipesan">Dipesan</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="submit" class="btn btn-orange w-100 py-3 rounded-pill fw-bold shadow-sm" style="font-size: 1.1rem;">UPDATE DATA UNIT</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Lihat Bukti -->
<div class="modal fade" id="modalBukti" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-5 overflow-hidden">
            <div class="modal-header border-0 pb-0 pt-4 px-4 bg-light bg-opacity-50">
                <h5 class="fw-bold">Verifikasi Pembayaran</h5>
                <button type="button" class="btn-close bg-light rounded-circle p-2" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4 text-center">
                <div class="bg-light p-2 rounded-4 mb-4 border d-inline-block">
                    <img id="imgBukti" src="" class="img-fluid rounded-3 shadow-sm" style="max-height: 400px; object-fit: contain;">
                </div>
                <div id="divVerifyAction">
                    <!-- Form akan diisi via JS -->
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function lihatBukti(url, bookingId, status) {
        document.getElementById('imgBukti').src = url;
        const divAction = document.getElementById('divVerifyAction');
        
        if (status === 'Paid') {
            divAction.innerHTML = '<div class="alert alert-success border-0 rounded-pill fw-bold shadow-sm d-inline-flex align-items-center gap-2"><i data-lucide="check-circle" size="18"></i> PEMBAYARAN TERVERIFIKASI</div>';
        } else {
            divAction.innerHTML = `
                <form action="/admin/confirm-payment/${bookingId}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-orange w-100 py-3 rounded-pill fw-bold shadow-sm d-flex justify-content-center align-items-center gap-2" style="font-size: 1.1rem;">
                        <i data-lucide="check-square"></i> KONFIRMASI PEMBAYARAN VALID
                    </button>
                </form>
            `;
        }
        new bootstrap.Modal(document.getElementById('modalBukti')).show();
        setTimeout(() => lucide.createIcons(), 100);
    }

    function editUnit(id, tipe, lokasi, harga, status) {
        document.getElementById('edit_id').value = id;
        document.getElementById('edit_id_original').value = id;
        document.getElementById('edit_tipe').value = tipe;
        document.getElementById('edit_lokasi').value = lokasi;
        document.getElementById('edit_harga').value = harga;
        document.getElementById('edit_status').value = status;
        new bootstrap.Modal(document.getElementById('modalEditUnit')).show();
    }

    function hapusUnit(id) {
        if (confirm('Yakin ingin menghapus unit ' + id + '?')) {
            fetch('/admin/destroy/' + id, {
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) { location.reload(); }
                else { alert('Gagal: ' + data.message); }
            });
        }
    }

    document.getElementById('formEditUnit').addEventListener('submit', function(e) {
        e.preventDefault();
        const id = document.getElementById('edit_id_original').value;
        const formData = new FormData(this);
        formData.append('_method', 'PUT');

        fetch('/admin/update/' + id, {
            method: 'POST',
            body: formData,
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) { location.reload(); }
            else { alert('Gagal: ' + data.message); }
        });
    });

    document.getElementById('formTambahUnit').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        fetch('/admin/store', {
            method: 'POST',
            body: formData,
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) { location.reload(); }
            else { alert('Gagal: ' + data.message); }
        });
    });

    // Auto-set harga berdasarkan tipe kamar
    function setHargaOtomatis(selectElement, inputId) {
        const tipe = selectElement.value;
        const inputHarga = document.getElementById(inputId) || document.querySelector(`input[name="harga"]`);
        if (tipe === 'Hemat') {
            inputHarga.value = 500000;
        } else if (tipe === 'Standar') {
            inputHarga.value = 800000;
        } else if (tipe === 'Premium') {
            inputHarga.value = 1200000;
        }
    }

    // Listener untuk Tambah Unit
    document.querySelector('#modalTambahUnit select[name="tipe"]').addEventListener('change', function() {
        setHargaOtomatis(this, null);
    });

    // Listener untuk Edit Unit
    document.getElementById('edit_tipe').addEventListener('change', function() {
        setHargaOtomatis(this, 'edit_harga');
    });
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
</style>
@endsection
