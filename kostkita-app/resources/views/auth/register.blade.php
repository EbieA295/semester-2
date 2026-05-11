@extends('layouts.app')

@section('content')
<div class="container py-5 mt-lg-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card border-0 shadow-lg p-4 p-md-5 rounded-5 bg-white overflow-hidden position-relative">
                <div class="position-absolute top-0 start-0 w-100 h-2 bg-orange" style="height: 6px; background: var(--primary-orange);"></div>
                
                <div class="text-center mb-5">
                    <div class="bg-soft-orange text-orange d-inline-flex p-3 rounded-4 mb-4">
                        <i data-lucide="user-plus" size="32"></i>
                    </div>
                    <h2 class="fw-800 mb-2">Buat Akun Baru</h2>
                    <p class="text-muted">Bergabunglah dengan ribuan mahasiswa lainnya dalam mencari kost terbaik.</p>
                </div>

                @if ($errors->any())
                <div class="alert alert-danger border-0 rounded-4 small mb-4">
                    <ul class="mb-0 fw-bold">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <label class="form-label small fw-bold text-muted">NAMA LENGKAP</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0 rounded-start-4 px-3"><i data-lucide="user" size="18" class="text-muted"></i></span>
                                <input type="text" name="name" class="form-control bg-light border-0 py-3 rounded-end-4" placeholder="Contoh: Ebie Aryansya" required value="{{ old('name') }}">
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label small fw-bold text-muted">EMAIL</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0 rounded-start-4 px-3"><i data-lucide="mail" size="18" class="text-muted"></i></span>
                                <input type="email" name="email" class="form-control bg-light border-0 py-3 rounded-end-4" placeholder="nama@email.com" required value="{{ old('email') }}">
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label small fw-bold text-muted">NOMOR HP (WA)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0 rounded-start-4 px-3"><i data-lucide="phone" size="18" class="text-muted"></i></span>
                                <input type="text" name="no_hp" class="form-control bg-light border-0 py-3 rounded-end-4" placeholder="0812..." required value="{{ old('no_hp') }}">
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label small fw-bold text-muted">KATA SANDI</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0 rounded-start-4 px-3"><i data-lucide="lock" size="18" class="text-muted"></i></span>
                                <input type="password" name="password" class="form-control bg-light border-0 py-3 rounded-end-4" placeholder="••••••••" required>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label small fw-bold text-muted">KONFIRMASI SANDI</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0 rounded-start-4 px-3"><i data-lucide="check-circle" size="18" class="text-muted"></i></span>
                                <input type="password" name="password_confirmation" class="form-control bg-light border-0 py-3 rounded-end-4" placeholder="••••••••" required>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4 form-check">
                        <input type="checkbox" class="form-check-input" id="terms" required>
                        <label class="form-check-label small text-muted" for="terms">Saya menyetujui <a href="#" class="text-orange text-decoration-none fw-bold">Syarat & Ketentuan</a> yang berlaku.</label>
                    </div>

                    <button type="submit" class="btn btn-orange w-100 py-3 rounded-4 fw-bold">DAFTAR SEKARANG</button>
                </form>

                <div class="mt-5 text-center">
                    <p class="text-muted small mb-0">Sudah memiliki akun? <a href="{{ route('login') }}" class="text-orange fw-bold text-decoration-none">Masuk di sini</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection