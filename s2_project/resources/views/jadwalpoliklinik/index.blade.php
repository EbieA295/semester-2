@extends('layout.admin')

@extends('title', 'Jadwal Poliklinik')

@section('content')
<!--page heading -->
<h1 class="h3 mb-2 text-gray-800">Data Jadwal Poliklinik</h1>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Cari Berdasarkan Tanggal</h6>
    </div>
    <div class="card-body">
        <form action="{{route ('jadwalPoliklinik.index')}}" method="GET" class="row">
            <div class="col-md-4 mb3">
                <label for="star_date">Dari Tanggal</label>
                <div class="input-group">
                    <input type="date" class="form-control" id="star_date" name="star_date" value="{{ request()->input('start_date') }}">
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <label for="star_date">Sampai Tanggal</label>
                <div class="input_group">
                    <input type="date" class="form-control" id="end_date" name="end_date" value="{{ request()->input('end_date') }}">
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <button type="submit" class="btn btn-primary btn-sm mr-1"><i class="fas fa-search"></i> Search</button>
                <a href="{{route('jadwalPoliklinik.index')}}" class="btn btn-secondary btn-sm"><i class="fas fa-sync-alt"></i>Refresh</a>
            </div>
        </form>
    </div>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="{{ route('jadwalPoliklinik.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama Dokter</th>
                        <th>Nama Poliklinik</th>
                        <th>Profil Dokter</th>
                        <th>Tanggal Praktek</th>
                        <th>Jam Praktek</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($jadwalpoliklinik as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->kode }}</td>
                            <td>{{ $item->dokter->nama_dokter }}</td>
                            <td>{{ $item->dokter->poliklinik->nama_poliklinik }}</td>
                            <td>
                                <img src="{{ asset('storage/foto_dokter/' . $item->dokter->foto_dokter) }}" alt="Foto Dokter" width="50" height="50">
                            </td>
                            <td>{{ $item->tanggal_praktek }}</td>
                            <td>{{ $item->jam_mulai }}</td>
                            <td>{{ $jumlah }}</td>
                            <td>
                                <a href="{{ route('jadwalpoliklinik.edit', $item->id) }}" class="btn btn-warning btn-sm">edit</a>
                                <form action="{{ route('jadwalpoliklinik.destroy', $item->id) }}" method="POST" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm btn-delete" onclick="deletejadwak({{ $item->id }})">
                                        Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    @include('sweetalert::alert')
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- sertakan SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<!-- sertakan file javascript khusus -->
<script src="{{ asset('js/sweetalert.js') }}"></script>
@endsection
