<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login KostKita</title>
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font khusus untuk laporan agar mirip dengan PDF Job Sheet -->
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .card-login {
            border-radius: 25px; /* Sudut sangat bulat sesuai gambar.jpg */
            border: none;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
            max-width: 400px;
            width: 100%;
        }
        .btn-orange {
            background-color: #fd7e14; /* Warna Oranye KostKita */
            color: white;
            font-weight: bold;
            border-radius: 12px;
            padding: 12px;
            transition: all 0.3s;
        }
        .btn-orange:hover {
            background-color: #e8590c;
            color: white;
            transform: translateY(-2px);
        }
        .form-control {
            border-radius: 12px;
            padding: 12px;
            background-color: #fdfdfd;
        }
        .logo-container {
            background-color: #fd7e14;
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
        }
    </style>
</head>
<body class="d-flex align-items-center min-vh-100">

<div class="container">
    <div class="row justify-content-center">
        <div class="card card-login p-4">
            <!-- Bagian Header/Logo sesuai gambar.jpg -->
            <div class="text-center mb-4">
                <div class="logo-container shadow-sm text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
                        <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5Z"/>
                    </svg>
                </div>
                <h2 class="fw-bold mb-1">KostKita</h2>
                <h4 class="fw-semibold text-dark">Selamat Datang Kembali!</h4>
                <p class="text-muted small">Silakan masuk ke akun Anda</p>
            </div>

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <!-- Input Email/No HP -->
                <div class="mb-3">
                    <label class="form-label small fw-bold text-secondary">Email atau Nomor HP</label>
                    <input type="email" name="email" class="form-control" placeholder="Masukkan Email atau No. HP" required>
                </div>

                <!-- Input Password -->
                <div class="mb-3">
                    <label class="form-label small fw-bold text-secondary">Kata Sandi</label>
                    <input type="password" name="password" class="form-control" placeholder="Masukkan kata sandi" required>
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="d-flex justify-content-between align-items-center mb-4 small">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="remember">
                        <label class="form-check-label text-muted" for="remember">Ingat Saya</label>
                    </div>
                    <a href="#" class="text-decoration-none fw-bold" style="color: #fd7e14;">Lupa Kata Sandi?</a>
                </div>

                <!-- Submit Button -->
                <div class="d-grid shadow-sm">
                    <button type="submit" class="btn btn-orange text-uppercase">Masuk</button>
                </div>
            </form>

            <!-- Footer Daftar -->
            <div class="mt-4 text-center">
                <p>Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></p>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap 5 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>