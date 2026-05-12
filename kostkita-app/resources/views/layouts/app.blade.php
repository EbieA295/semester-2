<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>KostKita - Cari Kost Nyaman</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/premium.css') }}" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            overflow-x: hidden;
            scroll-behavior: smooth;
        }

        /* Navbar Modern */
        .navbar {
            padding: 1.2rem 0;
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .navbar-brand {
            font-weight: 800;
            color: var(--primary-orange) !important;
            font-size: 1.6rem;
            letter-spacing: -0.5px;
        }

        .nav-link {
            font-weight: 600;
            color: var(--text-muted) !important;
            padding: 0.5rem 1.2rem !important;
            transition: 0.3s;
        }

        body.dark-mode .nav-link {
            color: var(--dark-text-muted) !important;
        }

        .nav-link:hover, .nav-link.active {
            color: var(--primary-orange) !important;
        }
        
        .theme-toggle {
            cursor: pointer;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: var(--bg-light);
            transition: all 0.3s;
            border: 1px solid var(--border-light);
            color: var(--text-main);
        }
        
        body.dark-mode .theme-toggle {
            background: var(--dark-surface-2);
            border-color: var(--dark-border);
            color: var(--dark-text);
        }
        
        .theme-toggle:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg sticky-top glass-effect">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="/">
                <span style="font-size: 1.8rem;">🏠</span> KostKita
            </a>
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i data-lucide="menu" size="28" class="text-orange"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center gap-2">
                    <li class="nav-item"><a class="nav-link" href="/">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="/#daftar-kamar">Cari Kost</a></li>
                    
                    <li class="nav-item mx-2">
                        <div class="theme-toggle shadow-sm" onclick="toggleDarkMode()">
                            <i data-lucide="moon" id="theme-icon" size="18"></i>
                        </div>
                    </li>

                    @guest
                        <li class="nav-item ms-lg-3">
                            <a href="/login" class="nav-link fw-bold text-dark">Masuk</a>
                        </li>
                        <li class="nav-item">
                            <a href="/register" class="btn btn-orange rounded-pill px-4">Daftar</a>
                        </li>
                    @else
                        <li class="nav-item dropdown ms-lg-3">
                            <a class="btn bg-white border dropdown-toggle rounded-pill px-3 shadow-sm text-dark d-flex align-items-center gap-2" href="#" role="button" data-bs-toggle="dropdown">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=FF6B00&color=fff" class="rounded-circle" width="24" height="24">
                                <span class="fw-bold" style="font-size: 14px;">{{ explode(' ', Auth::user()->name)[0] }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg mt-3 rounded-4 p-2" style="min-width: 200px;">
                                <li>
                                    @if(Auth::user()->role == 'admin')
                                        <a class="dropdown-item py-2 rounded-3 d-flex align-items-center gap-2 fw-medium" href="/admin"><i data-lucide="layout-dashboard" size="16"></i> Dashboard Admin</a>
                                    @elseif(Auth::user()->role == 'owner')
                                        <a class="dropdown-item py-2 rounded-3 d-flex align-items-center gap-2 fw-medium" href="/pemilik"><i data-lucide="layout-dashboard" size="16"></i> Dashboard Pemilik</a>
                                    @else
                                        <a class="dropdown-item py-2 rounded-3 d-flex align-items-center gap-2 fw-medium" href="/customer"><i data-lucide="layout-dashboard" size="16"></i> Dashboard Saya</a>
                                    @endif
                                </li>
                                <li><hr class="dropdown-divider my-2 opacity-50"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item py-2 rounded-3 text-danger d-flex align-items-center gap-2 fw-bold"><i data-lucide="log-out" size="16"></i> Keluar</button>
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

    <!-- Footer Premium -->
    <footer class="mt-5 py-5 border-top bg-white">
        <div class="container text-center text-md-start">
            <div class="row g-4">
                <div class="col-md-4">
                    <h4 class="fw-800 text-orange mb-3">🏠 KostKita</h4>
                    <p class="text-muted small">Platform pencarian kost no.1 dengan ribuan pilihan kamar nyaman dan aman untuk mahasiswa dan pekerja.</p>
                </div>
                <div class="col-md-2 offset-md-2">
                    <h6 class="fw-bold mb-3">Menu</h6>
                    <ul class="list-unstyled small d-flex flex-column gap-2">
                        <li><a href="/" class="text-muted text-decoration-none">Beranda</a></li>
                        <li><a href="/#daftar-kamar" class="text-muted text-decoration-none">Cari Kost</a></li>
                        <li><a href="/login" class="text-muted text-decoration-none">Masuk</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h6 class="fw-bold mb-3">Hubungi Kami</h6>
                    <ul class="list-unstyled small text-muted d-flex flex-column gap-2">
                        <li class="d-flex align-items-center gap-2"><i data-lucide="mail" size="16"></i> ebiearyansya@gmail.com</li>
                        <li class="d-flex align-items-center gap-2"><i data-lucide="phone" size="16"></i> 0823-5915-7819</li>
                        <li class="d-flex align-items-center gap-2"><i data-lucide="map-pin" size="16"></i> Pasar Semerap Kerinci Jambi</li>
                    </ul>
                </div>
            </div>
            <div class="text-center mt-5 pt-4 border-top small text-muted">
                &copy; {{ date('Y') }} KostKita. All rights reserved.
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();
        
        // Dark Mode Logic
        function toggleDarkMode() {
            document.body.classList.toggle('dark-mode');
            const isDark = document.body.classList.contains('dark-mode');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
            
            const icon = document.getElementById('theme-icon');
            if (isDark) {
                icon.setAttribute('data-lucide', 'sun');
            } else {
                icon.setAttribute('data-lucide', 'moon');
            }
            lucide.createIcons();
        }

        // Check saved theme
        if (localStorage.getItem('theme') === 'dark') {
            document.body.classList.add('dark-mode');
            setTimeout(() => {
                const icon = document.getElementById('theme-icon');
                if(icon) {
                    icon.setAttribute('data-lucide', 'sun');
                    lucide.createIcons();
                }
            }, 100);
        }
    </script>
</body>
</html>
