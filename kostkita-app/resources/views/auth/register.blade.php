<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - KostKita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #F8F9FA; font-family: 'Plus Jakarta Sans', sans-serif; }
        .card-register { border-radius: 20px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
        .btn-orange { background: #F47B20; color: white; font-weight: 600; border-radius: 10px; }
        .btn-orange:hover { background: #d66a1a; color: white; }
    </style>
</head>
<body class="d-flex align-items-center vh-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card card-register p-4">
                    <div class="text-center mb-4">
                        <h2 class="fw-bold text-orange" style="color: #F47B20;">🏠 KostKita</h2>
                        <p class="text-muted small">Daftar sekarang untuk mulai mencari kost</p>
                    </div>
                    
                    @if ($errors->any())
                    <div class="alert alert-danger shadow-sm border-0" style="border-radius: 10px;">
                        <ul class="mb-0 small fw-bold">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="small fw-bold">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control bg-light border-0" placeholder="Ebie Aryansya" required>
                        </div>
                        <div class="mb-3">
                            <label class="small fw-bold">Email</label>
                            <input type="email" name="email" class="form-control bg-light border-0" placeholder="name@example.com" required>
                        </div>
                        <div class="mb-3">
                            <label class="small fw-bold mb-1">Nomor HP</label>
                            <input type="text" name="no_hp" class="form-control bg-light border-0 py-2" placeholder="0812xxxxxxxx" required>
                        </div>
                        <div class="mb-3">
                            <label class="small fw-bold">Password</label>
                            <input type="password" name="password" class="form-control bg-light border-0" required>
                        </div>
                        <div class="mb-4">
                            <label class="small fw-bold">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="form-control bg-light border-0" required>
                        </div>
                        <button type="submit" class="btn btn-orange w-100 py-2">Daftar Akun</button>
                    </form>
                    
                    <div class="text-center mt-4">
                        <p class="small text-muted">Sudah punya akun? <a href="{{ route('login') }}" class="text-decoration-none text-orange" style="color: #F47B20;">Login di sini</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>