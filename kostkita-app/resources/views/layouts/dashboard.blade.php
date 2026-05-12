<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - KostKita Dashboard</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/premium.css') }}" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-light);
            color: var(--text-main);
            overflow-x: hidden;
        }

        /* Sidebar Styling */
        #sidebar {
            min-width: 280px;
            max-width: 280px;
            background-color: var(--dark-surface);
            color: white;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            min-height: 100vh;
            position: fixed;
            z-index: 1000;
            border-right: 1px solid var(--dark-border);
        }

        .sidebar-header {
            padding: 30px;
            font-weight: 800;
            font-size: 1.5rem;
            color: var(--primary-orange);
            border-bottom: 1px solid rgba(255,255,255,0.05);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar-menu {
            padding: 20px 15px;
        }

        .nav-link-sidebar {
            display: flex;
            align-items: center;
            padding: 14px 20px;
            color: var(--dark-text-muted);
            text-decoration: none;
            border-radius: 12px;
            margin-bottom: 8px;
            font-weight: 600;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }

        .nav-link-sidebar:hover {
            background: rgba(255,255,255,0.05);
            color: white;
            transform: translateX(5px);
        }

        .nav-link-sidebar.active {
            background: linear-gradient(135deg, var(--primary-orange), var(--accent-orange));
            color: white;
            box-shadow: 0 4px 15px rgba(255, 107, 0, 0.3);
        }

        .nav-link-sidebar i {
            margin-right: 15px;
            width: 20px;
            transition: transform 0.3s;
        }
        
        .nav-link-sidebar:hover i {
            transform: scale(1.1);
        }

        /* Content Wrapper */
        #content {
            width: 100%;
            padding-left: 280px;
            min-height: 100vh;
            transition: all 0.3s;
        }

        .top-nav {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            padding: 15px 40px;
            border-bottom: 1px solid var(--border-light);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 900;
            transition: all 0.3s;
        }
        
        body.dark-mode .top-nav {
            background: rgba(21, 29, 44, 0.8);
            border-bottom-color: var(--dark-border);
        }

        .main-container {
            padding: 40px;
        }
        
        .theme-toggle-dashboard {
            cursor: pointer;
            width: 36px; height: 36px;
            display: flex; align-items: center; justify-content: center;
            border-radius: 50%;
            background: var(--bg-light);
            border: 1px solid var(--border-light);
            color: var(--text-main);
            transition: 0.3s;
        }
        
        body.dark-mode .theme-toggle-dashboard {
            background: var(--dark-surface-2);
            border-color: var(--dark-border);
            color: var(--dark-text);
        }

        @media (max-width: 992px) {
            #sidebar { margin-left: -280px; }
            #content { padding-left: 0; }
            #sidebar.active { margin-left: 0; }
        }
    </style>
</head>
<body>

<div class="d-flex">
    <!-- Sidebar -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <span style="font-size: 1.8rem;">🏠</span> KostKita
        </div>
        <div class="sidebar-menu">
            <div class="small text-uppercase fw-bold text-muted mb-3 px-3" style="letter-spacing: 1px; font-size: 10px;">Menu Utama</div>
            
            @if(Auth::user()->role == 'admin')
                <a href="/admin" class="nav-link-sidebar {{ Request::is('admin*') ? 'active' : '' }}">
                    <i data-lucide="layout-dashboard"></i> Dashboard
                </a>
                <a href="/admin" class="nav-link-sidebar">
                    <i data-lucide="home"></i> Kelola Kamar
                </a>
                <a href="/admin" class="nav-link-sidebar">
                    <i data-lucide="users"></i> Data Penyewa
                </a>
                <a href="/admin" class="nav-link-sidebar">
                    <i data-lucide="credit-card"></i> Transaksi
                </a>
            @elseif(Auth::user()->role == 'owner')
                <a href="/pemilik" class="nav-link-sidebar {{ Request::is('pemilik*') ? 'active' : '' }}">
                    <i data-lucide="layout-dashboard"></i> Dashboard
                </a>
                <a href="/pemilik" class="nav-link-sidebar">
                    <i data-lucide="home"></i> Unit Kost Saya
                </a>
                <a href="/pemilik" class="nav-link-sidebar">
                    <i data-lucide="trending-up"></i> Laporan Keuangan
                </a>
            @else
                <a href="/customer" class="nav-link-sidebar {{ Request::is('customer*') ? 'active' : '' }}">
                    <i data-lucide="layout-dashboard"></i> Dashboard Saya
                </a>
                <a href="/" class="nav-link-sidebar">
                    <i data-lucide="search"></i> Cari Kost
                </a>
                <a href="#" class="nav-link-sidebar d-flex justify-content-between align-items-center">
                    <span class="d-flex align-items-center"><i data-lucide="heart"></i> Wishlist</span>
                    <span class="badge bg-soft-orange text-orange rounded-pill shadow-sm">{{ Auth::user()->wishlists()->count() }}</span>
                </a>
                <a href="/customer" class="nav-link-sidebar d-flex justify-content-between align-items-center">
                    <span class="d-flex align-items-center"><i data-lucide="history"></i> Riwayat Booking</span>
                    <span class="badge bg-light text-muted rounded-pill shadow-sm">{{ App\Models\Booking::where('nama_penyewa', Auth::user()->name)->count() }}</span>
                </a>
            @endif
            
            <div class="small text-uppercase fw-bold text-muted mt-5 mb-3 px-3" style="letter-spacing: 1px; font-size: 10px;">Pengaturan</div>
            
            <a href="/" class="nav-link-sidebar">
                <i data-lucide="arrow-left"></i> Kembali ke Web
            </a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="nav-link-sidebar w-100 border-0 bg-transparent text-start text-danger hover-opacity">
                    <i data-lucide="log-out"></i> Keluar
                </button>
            </form>
        </div>
    </nav>

    <!-- Page Content -->
    <div id="content">
        <nav class="top-nav">
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-light d-lg-none" id="sidebarToggle">
                    <i data-lucide="menu"></i>
                </button>
                <h5 class="fw-bold mb-0 text-muted">@yield('page_title')</h5>
            </div>
            
            <div class="d-flex align-items-center gap-4">
                <div class="theme-toggle-dashboard" onclick="toggleDashboardTheme()" title="Toggle Dark Mode">
                    <i data-lucide="moon" id="dash-theme-icon" size="18"></i>
                </div>
                
                <div class="d-flex align-items-center gap-3 border-start ps-4">
                    <div class="text-end d-none d-md-block">
                        <div class="fw-bold small">{{ Auth::user()->name }}</div>
                        <div class="text-orange fw-bold" style="font-size: 10px; text-transform: uppercase; letter-spacing: 1px;">{{ Auth::user()->role }}</div>
                    </div>
                    <div class="position-relative">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=FF6B00&color=fff" class="rounded-circle shadow-sm border border-2 border-white" width="45" height="45">
                        <span class="position-absolute bottom-0 end-0 bg-success border border-2 border-white rounded-circle" style="width: 12px; height: 12px;"></span>
                    </div>
                </div>
            </div>
        </nav>

        <div class="main-container">
            @yield('content')
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/lucide@latest"></script>
<script>
    lucide.createIcons();
    
    // Mobile Sidebar Toggle
    document.getElementById('sidebarToggle')?.addEventListener('click', function() {
        document.getElementById('sidebar').classList.toggle('active');
    });
    
    // Dark Mode Logic
    function toggleDashboardTheme() {
        document.body.classList.toggle('dark-mode');
        const isDark = document.body.classList.contains('dark-mode');
        localStorage.setItem('theme', isDark ? 'dark' : 'light');
        
        const icon = document.getElementById('dash-theme-icon');
        if (isDark) {
            icon.setAttribute('data-lucide', 'sun');
        } else {
            icon.setAttribute('data-lucide', 'moon');
        }
        lucide.createIcons();
    }

    if (localStorage.getItem('theme') === 'dark') {
        document.body.classList.add('dark-mode');
        setTimeout(() => {
            const icon = document.getElementById('dash-theme-icon');
            if(icon) {
                icon.setAttribute('data-lucide', 'sun');
                lucide.createIcons();
            }
        }, 100);
    }
</script>
</body>
</html>
