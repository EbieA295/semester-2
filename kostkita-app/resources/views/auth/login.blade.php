@extends('layouts.app')

@section('content')
<div class="container py-5 mt-lg-5">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card border-0 shadow-lg p-4 p-md-5 rounded-5 bg-white overflow-hidden position-relative">
                <div class="position-absolute top-0 start-0 w-100 h-2 bg-orange" style="height: 6px; background: var(--primary-orange);"></div>
                
                <div class="text-center mb-5">
                    <div class="bg-soft-orange text-orange d-inline-flex p-3 rounded-4 mb-4">
                        <i data-lucide="log-in" size="32"></i>
                    </div>
                    <h2 class="fw-800 mb-2">Selamat Datang!</h2>
                    <p class="text-muted">Masuk ke akun KostKita Anda untuk melanjutkan pencarian kost impian.</p>
                </div>

                @if($errors->any())
                    <div class="alert alert-danger border-0 rounded-4 small mb-4">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-muted">EMAIL</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0 rounded-start-4 px-3"><i data-lucide="mail" size="18" class="text-muted"></i></span>
                            <input type="email" name="email" class="form-control bg-light border-0 py-3 rounded-end-4" placeholder="nama@email.com" required value="{{ old('email') }}">
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="d-flex justify-content-between">
                            <label class="form-label small fw-bold text-muted">KATA SANDI</label>
                            <a href="#" class="text-orange small fw-bold text-decoration-none">Lupa Sandi?</a>
                        </div>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0 rounded-start-4 px-3"><i data-lucide="lock" size="18" class="text-muted"></i></span>
                            <input type="password" name="password" class="form-control bg-light border-0 py-3 rounded-end-4" placeholder="••••••••" required>
                        </div>
                    </div>

                    <div class="mb-4 form-check">
                        <input type="checkbox" class="form-check-input" id="remember">
                        <label class="form-check-label small text-muted" for="remember">Ingat saya di perangkat ini</label>
                    </div>

                    <button type="submit" class="btn btn-orange w-100 py-3 rounded-4 fw-bold">MASUK SEKARANG</button>
                </form>

                <div class="mt-5 text-center">
                    <p class="text-muted small mb-0">Belum memiliki akun? <a href="{{ route('register') }}" class="text-orange fw-bold text-decoration-none">Daftar Sekarang</a></p>
                </div>
            </div>

            <div class="mt-4 text-center">
                <p class="text-muted extra-small" style="font-size: 11px;">&copy; 2026 KostKita Platform. Keamanan data Anda prioritas kami.</p>
            </div>
        </div>
    </div>
</div>
@endsection