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
    
    <style>
        :root {
            --primary-orange: #F47B20;
            --secondary-orange: #FF9F1C;
            --soft-orange: #FFF4F0;
            --sidebar-bg: #111827;
            --sidebar-text: #9CA3AF;
            --sidebar-active: #F47B20;
            --bg-gray: #F9FAFB;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-gray);
            color: #111827;
        }

        /* Sidebar Styling */
        #sidebar {
            min-width: 280px;
            max-width: 280px;
            background-color: var(--sidebar-bg);
            color: white;
            transition: all 0.3s;
            min-height: 100vh;
            position: fixed;
            z-index: 1000;
        }

        .sidebar-header {
            padding: 30px;
            font-weight: 800;
            font-size: 1.5rem;
            color: var(--primary-orange);
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }

        .sidebar-menu {
            padding: 20px 15px;
        }

        .nav-link-sidebar {
            display: flex;
            align-items: center;
            padding: 14px 20px;
            color: var(--sidebar-text);
            text-decoration: none;
            border-radius: 12px;
            margin-bottom: 8px;
            font-weight: 600;
            transition: all 0.2s;
        }

        .nav-link-sidebar:hover {
            background: rgba(255,255,255,0.05);
            color: white;
        }

        .nav-link-sidebar.active {
            background: var(--primary-orange);
            color: white;
            box-shadow: 0 4px 12px rgba(244, 123, 32, 0.3);
        }

        .nav-link-sidebar i {
            margin-right: 15px;
            width: 20px;
        }

        /* Content Wrapper */
        #content {
            width: 100%;
            padding-left: 280px;
            min-height: 100vh;
            transition: all 0.3s;
        }

        .top-nav {
            background: white;
            padding: 15px 40px;
            border-bottom: 1px solid #E5E7EB;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 900;
        }

        .main-container {
            padding: 40px;
        }

        /* Premium Cards */
        .card-stats {
            border: none;
            border-radius: 24px;
            padding: 25px;
            background: white;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03);
            transition: transform 0.3s ease;
        }
        .card-stats:hover {
            transform: translateY(-5px);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
        }

        .table-premium {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
        }
        .table-premium th {
            background: #F9FAFB;
            padding: 18px 25px;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 0.5px;
            color: #6B7280;
            border: none;
        }
        .table-premium td {
            padding: 18px 25px;
            vertical-align: middle;
            border-bottom: 1px solid #F3F4F6;
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
            🏠 KostKita
        </div>
        <div class="sidebar-menu">
            @if(Auth::user()->role == 'admin')
                <a href="/admin" class="nav-link-sidebar {{ Request::is('admin*') ? 'active' : '' }}">
                    <i data-lucide="layout-dashboard"></i> Dashboard
                </a>
                <a href="#" class="nav-link-sidebar">
                    <i data-lucide="home"></i> Kelola Kamar
                </a>
                <a href="#" class="nav-link-sidebar">
                    <i data-lucide="users"></i> Data Penyewa
                </a>
                <a href="#" class="nav-link-sidebar">
                    <i data-lucide="credit-card"></i> Transaksi
                </a>
            @elseif(Auth::user()->role == 'owner')
                <a href="/pemilik" class="nav-link-sidebar {{ Request::is('pemilik*') ? 'active' : '' }}">
                    <i data-lucide="layout-dashboard"></i> Dashboard
                </a>
                <a href="#" class="nav-link-sidebar">
                    <i data-lucide="home"></i> Unit Kost Saya
                </a>
                <a href="#" class="nav-link-sidebar">
                    <i data-lucide="trending-up"></i> Laporan Keuangan
                </a>
            @else
                <a href="#" class="nav-link-sidebar {{ Request::is('customer*') ? 'active' : '' }}">
                    <i data-lucide="search"></i> Cari Kost
                </a>
                <a href="#" class="nav-link-sidebar d-flex justify-content-between align-items-center">
                    <span class="d-flex align-items-center"><i data-lucide="heart"></i> Wishlist</span>
                    <span class="badge bg-soft-orange text-orange rounded-pill" style="font-size: 10px;">{{ Auth::user()->wishlists()->count() }}</span>
                </a>
                <a href="#" class="nav-link-sidebar d-flex justify-content-between align-items-center">
                    <span class="d-flex align-items-center"><i data-lucide="history"></i> Riwayat Booking</span>
                    <span class="badge bg-light text-muted rounded-pill" style="font-size: 10px;">0</span>
                </a>
            @endif
            
            <div style="margin-top: 100px;">
                <a href="/" class="nav-link-sidebar">
                    <i data-lucide="arrow-left"></i> Kembali ke Web
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="nav-link-sidebar w-100 border-0 bg-transparent text-start">
                        <i data-lucide="log-out"></i> Keluar
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <div id="content">
        <nav class="top-nav">
            <h5 class="fw-bold mb-0 text-muted">@yield('page_title')</h5>
            <div class="d-flex align-items-center gap-3">
                <div class="text-end d-none d-md-block">
                    <div class="fw-bold small">{{ Auth::user()->name }}</div>
                    <div class="text-muted extra-small" style="font-size: 10px; text-transform: uppercase;">{{ Auth::user()->role }}</div>
                </div>
                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=F47B20&color=fff" class="rounded-circle shadow-sm" width="40">
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
</script>
</body>
</html>
