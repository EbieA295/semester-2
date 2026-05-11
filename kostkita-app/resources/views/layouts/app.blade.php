<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>KostKita - Cari Kost Nyaman</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --primary-orange: #F47B20;
            --secondary-orange: #FF9F1C;
            --soft-orange: #FFF4F0;
            --dark-gray: #111827;
            --medium-gray: #4B5563;
            --light-gray: #F3F4F6;
            --glass-bg: rgba(255, 255, 255, 0.8);
            --glass-border: rgba(244, 123, 32, 0.1);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #FAFAFA;
            color: var(--dark-gray);
            overflow-x: hidden;
            scroll-behavior: smooth;
        }

        /* Navbar Modern */
        .navbar {
            background: var(--glass-bg) !important;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--glass-border);
            padding: 1.2rem 0;
            transition: all 0.3s ease;
        }

        .navbar-brand {
            font-weight: 800;
            color: var(--primary-orange) !important;
            font-size: 1.6rem;
            letter-spacing: -0.5px;
        }

        .nav-link {
            font-weight: 600;
            color: var(--medium-gray) !important;
            padding: 0.5rem 1.2rem !important;
            transition: 0.3s;
        }

        .nav-link:hover, .nav-link.active {
            color: var(--primary-orange) !important;
        }

        /* Premium Buttons */
        .btn-orange {
            background: linear-gradient(135deg, var(--primary-orange), var(--secondary-orange));
            color: white !important;
            border: none;
            font-weight: 700;
            border-radius: 14px;
            padding: 12px 28px;
            box-shadow: 0 4px 15px rgba(244, 123, 32, 0.2);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .btn-orange:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(244, 123, 32, 0.35);
        }

        .btn-outline-orange {
            border: 2px solid var(--primary-orange);
            color: var(--primary-orange);
            font-weight: 700;
            border-radius: 14px;
            padding: 10px 24px;
            transition: 0.3s;
        }

        .btn-outline-orange:hover {
            background: var(--primary-orange);
            color: white;
        }

        /* Utility Classes */
        .fw-800 { font-weight: 800; }
        .text-orange { color: var(--primary-orange); }
        .bg-soft-orange { background-color: var(--soft-orange); }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="/">🏠 KostKita</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center gap-2">
                    <li class="nav-item"><a class="nav-link" href="/">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="/#daftar-kamar">Cari Kost</a></li>
                    @guest
                        <li class="nav-item ms-lg-3">
                            <a href="/login" class="nav-link fw-bold text-dark">Masuk</a>
                        </li>
                        <li class="nav-item">
                            <a href="/register" class="btn btn-orange">Daftar</a>
                        </li>
                    @else
                        <li class="nav-item dropdown ms-lg-3">
                            <a class="btn btn-light dropdown-toggle rounded-pill px-3 shadow-sm border" href="#" role="button" data-bs-toggle="dropdown">
                                <span class="me-1">👤</span> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg mt-3 rounded-4">
                                <li>
                                    @if(Auth::user()->role == 'admin')
                                        <a class="dropdown-item py-2" href="/admin">Dashboard Admin</a>
                                    @elseif(Auth::user()->role == 'owner')
                                        <a class="dropdown-item py-2" href="/pemilik">Dashboard Pemilik</a>
                                    @else
                                        <a class="dropdown-item py-2" href="/customer">Dashboard Saya</a>
                                    @endif
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item py-2 text-danger">Keluar</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();
    </script>
</body>
</html>
