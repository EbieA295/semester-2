@extends('layouts.dashboard')

@section('title', 'Admin Dashboard')
@section('page_title', 'Dashboard Ringkasan')

@section('content')
<div class="row g-4 mb-5">
    <div class="col-md-3">
        <div class="card-stats">
            <div class="stat-icon" style="background: #FFF4F0; color: #F47B20;">
                <i data-lucide="home"></i>
            </div>
            <div class="text-muted extra-small fw-bold text-uppercase">Total Unit</div>
            <h3 class="fw-800 mb-0">{{ $totalUnits ?? 0 }}</h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card-stats">
            <div class="stat-icon" style="background: #ECFDF5; color: #10B981;">
                <i data-lucide="check-circle"></i>
            </div>
            <div class="text-muted extra-small fw-bold text-uppercase">Tersedia</div>
            <h3 class="fw-800 mb-0">{{ $availableUnits ?? 0 }}</h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card-stats">
            <div class="stat-icon" style="background: #FEF2F2; color: #EF4444;">
                <i data-lucide="user-check"></i>
            </div>
            <div class="text-muted extra-small fw-bold text-uppercase">Terisi</div>
            <h3 class="fw-800 mb-0">{{ $occupiedUnits ?? 0 }}</h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card-stats">
            <div class="stat-icon" style="background: #EFF6FF; color: #3B82F6;">
                <i data-lucide="clock"></i>
            </div>
            <div class="text-muted extra-small fw-bold text-uppercase">Antrean</div>
            <h3 class="fw-800 mb-0">{{ $pendingBookings ?? 0 }}</h3>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card border-0 rounded-4 shadow-sm bg-white overflow-hidden mb-4">
            <div class="p-4 border-bottom d-flex justify-content-between align-items-center">
                <h6 class="fw-bold mb-0">Antrean Konfirmasi Booking</h6>
                <span class="badge bg-soft-orange text-orange rounded-pill">{{ count($bookings) }} Request</span>
            </div>
            <div class="table-responsive">
                <table class="table table-premium mb-0">
                    <thead>
                        <tr>
                            <th>Unit</th>
                            <th>Penyewa</th>
                            <th>Tgl Masuk</th>
                            <th>Pembayaran</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings ?? [] as $b)
                        <tr>
                            <td class="fw-bold">{{ $b->unit_id }}</td>
                            <td>
                                <div class="fw-bold">{{ $b->nama_penyewa }}</div>
                                <div class="extra-small text-muted">{{ $b->no_hp }}</div>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($b->tgl_masuk)->format('d M Y') }}</td>
                            <td>
                                @if($b->payment_proof)
                                    <button onclick="lihatBukti('{{ asset('storage/'.$b->payment_proof) }}', '{{ $b->id }}', '{{ $b->payment_status }}')" class="btn btn-soft-orange btn-sm rounded-pill py-1">
                                        <i data-lucide="image" size="14"></i> Cek Bukti
                                    </button>
                                @else
                                    <span class="text-muted small">Belum Bayar</span>
                                @endif
                            </td>
                            <td class="text-end">
                                @if($b->status == 'Pending')
                                    <form action="{{ route('admin.konfirmasiBooking', $b->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-orange btn-sm rounded-pill px-3 fw-bold">Setujui</button>
                                    </form>
                                @elseif($b->status == 'Waiting for Payment')
                                    <span class="badge bg-light text-muted rounded-pill px-3">Menunggu Bayar</span>
                                @elseif($b->status == 'Confirmed')
                                    <span class="badge bg-success rounded-pill px-3">Selesai</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card border-0 rounded-4 shadow-sm bg-white overflow-hidden mb-4">
            <div class="p-4 border-bottom bg-light bg-opacity-50">
                <h6 class="fw-bold mb-0">Daftar Seluruh Unit Kost</h6>
            </div>
            <div class="table-responsive">
                <table class="table table-premium mb-0">
                    <thead>
                        <tr>
                            <th>ID Unit</th>
                            <th>Tipe</th>
                            <th>Lokasi</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($units ?? [] as $unit)
                        <tr>
                            <td class="fw-bold text-orange">{{ $unit->id }}</td>
                            <td>{{ $unit->tipe }}</td>
                            <td>{{ $unit->lokasi }}</td>
                            <td>Rp {{ number_format($unit->harga, 0, ',', '.') }}</td>
                            <td>
                                <span class="badge {{ $unit->status == 'Tersedia' ? 'bg-success' : ($unit->status == 'Terisi' ? 'bg-danger' : 'bg-warning') }} rounded-pill px-3 py-1">
                                    {{ $unit->status }}
                                </span>
                            </td>
                            <td class="text-end">
                                <button onclick="editUnit('{{ $unit->id }}', '{{ $unit->tipe }}', '{{ $unit->lokasi }}', '{{ $unit->harga }}', '{{ $unit->status }}')" class="btn btn-light btn-sm rounded-circle shadow-sm me-1"><i data-lucide="edit-2" size="14"></i></button>
                                <button onclick="hapusUnit('{{ $unit->id }}')" class="btn btn-light text-danger btn-sm rounded-circle shadow-sm"><i data-lucide="trash-2" size="14"></i></button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card border-0 rounded-4 shadow-sm bg-white p-4 mb-4">
            <h6 class="fw-bold mb-4">Aksi Cepat</h6>
            <div class="d-grid gap-3">
                <button class="btn btn-orange py-3 rounded-4 fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambahUnit">
                    <i data-lucide="plus-circle" class="me-2" style="width: 18px;"></i> Tambah Unit Baru
                </button>
                <button class="btn btn-light py-3 rounded-4 fw-bold">
                    <i data-lucide="file-text" class="me-2" style="width: 18px;"></i> Laporan Keuangan
                </button>
            </div>
        </div>

        <div class="card border-0 rounded-4 shadow-sm bg-white p-4">
            <h6 class="fw-bold mb-4 text-muted small text-uppercase">Peta Unit Kost</h6>
            <div class="d-flex flex-wrap gap-2">
                @foreach($units ?? [] as $unit)
                @php
                    $color = $unit->status == 'Tersedia' ? 'var(--primary-orange)' : ($unit->status == 'Terisi' ? '#EF4444' : '#F59E0B');
                @endphp
                <div class="rounded-3 p-2 text-center shadow-sm text-white" style="background: {{ $color }}; min-width: 50px; font-size: 11px; font-weight: 700;">
                    {{ $unit->id }}
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Unit -->
<div class="modal fade" id="modalTambahUnit" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-header border-0 p-4 pb-0">
                <h5 class="fw-bold">Tambah Unit Kost Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="formTambahUnit" enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">ID UNIT</label>
                        <input type="text" name="id" class="form-control rounded-3" placeholder="Contoh: A105" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">TIPE KAMAR</label>
                        <select name="tipe" class="form-select rounded-3" required>
                            <option value="Reguler">Reguler</option>
                            <option value="Premium">Premium</option>
                            <option value="Eksklusif">Eksklusif</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">LOKASI / LANTAI</label>
                        <input type="text" name="lokasi" class="form-control rounded-3" placeholder="Lantai 1" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">HARGA (Rp)</label>
                        <input type="number" name="harga" class="form-control rounded-3" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">STATUS</label>
                        <select name="status" class="form-select rounded-3" required>
                            <option value="Tersedia">Tersedia</option>
                            <option value="Terisi">Terisi</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="submit" class="btn btn-orange w-100 py-3 rounded-4 fw-bold">SIMPAN UNIT</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Unit -->
<div class="modal fade" id="modalEditUnit" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-header border-0 p-4 pb-0">
                <h5 class="fw-bold">Edit Unit Kost</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="formEditUnit">
                @csrf
                <div class="modal-body p-4">
                    <input type="hidden" id="edit_id_original">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">ID UNIT</label>
                        <input type="text" id="edit_id" class="form-control rounded-3" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">TIPE KAMAR</label>
                        <select id="edit_tipe" name="tipe" class="form-select rounded-3" required>
                            <option value="Reguler">Reguler</option>
                            <option value="Premium">Premium</option>
                            <option value="Eksklusif">Eksklusif</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">LOKASI / LANTAI</label>
                        <input type="text" id="edit_lokasi" name="lokasi" class="form-control rounded-3" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">HARGA (Rp)</label>
                        <input type="number" id="edit_harga" name="harga" class="form-control rounded-3" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">STATUS</label>
                        <select id="edit_status" name="status" class="form-select rounded-3" required>
                            <option value="Tersedia">Tersedia</option>
                            <option value="Terisi">Terisi</option>
                            <option value="Dipesan">Dipesan</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="submit" class="btn btn-orange w-100 py-3 rounded-4 fw-bold">UPDATE UNIT</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Lihat Bukti -->
<div class="modal fade" id="modalBukti" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-5 overflow-hidden">
            <div class="modal-header border-0 pb-0 pt-4 px-4">
                <h5 class="fw-bold">Verifikasi Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4 text-center">
                <img id="imgBukti" src="" class="img-fluid rounded-4 mb-4 shadow-sm border">
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
            divAction.innerHTML = '<div class="alert alert-success rounded-4 fw-bold">PEMBAYARAN TERVERIFIKASI</div>';
        } else {
            divAction.innerHTML = `
                <form action="/admin/confirm-payment/${bookingId}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-orange w-100 py-3 rounded-4 fw-bold shadow-sm">KONFIRMASI PEMBAYARAN</button>
                </form>
            `;
        }
        new bootstrap.Modal(document.getElementById('modalBukti')).show();
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
                if (data.success) { alert(data.message); location.reload(); }
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
            if (data.success) { alert(data.message); location.reload(); }
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
            if (data.success) { alert(data.message); location.reload(); }
            else { alert('Gagal: ' + data.message); }
        });
    });
</script>
@endsection
