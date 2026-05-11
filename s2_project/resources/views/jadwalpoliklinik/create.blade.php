@extends('layout.admin')

@extends('title', 'Tambah Jadwal Poliklinik')

@section('content')
<!--page heading -->

<h1 class="h3 mb-2 text-gray-800">Tambah Jadwal Poliklinik</h1>

<div class="card shadow mb-4">
    <div class="card-body">
        @if ($error->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($error->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('jadwalpoliklinik.add') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="dokter_id">Nama Dokter</label>
                <select class="form-control" id="dokter_id" name="dokter_id" required>
                    <option value="">Pilih Dokter</option>
                    @foreach ($dokters as $dokter)
                        <option value="{{ $dokter->id }}">{{ $dokter->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-grup">
                <label for="tanggal_praktek">Tanggal Praktek</label>
                <input type="date" class="form-control" id="tanggal_praktek" name="tanggal_praktek" required>
            </div>
            <div class="form-group">
                <label for="jam_mulai">Jam Mulai</label>
                <input type="time" class="form-control" id="jam_mulai" name="jam_mulai" required>
            </div>
            <div class="form-group">
                <label for="jam_selesai">Jam Selesai</label>
                <input type="time" class="form-control" id="jam_selesai" name="jam_selesai" required>
            </div>
            <div class="form-group">
                <label for="jumlah_pasien">Jumlah Pasien</label>
                <input type="number" class="form-control" id="jumlah_pasien" name="jumlah_pasien" required>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('jadwalPoliklinik.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
