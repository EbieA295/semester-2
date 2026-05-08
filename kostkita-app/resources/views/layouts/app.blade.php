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
            --primary-orange: #FF6B35;
            --secondary-orange: #FF9F1C;
            --soft-orange: #FFF4F0;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #FDFDFD;
            overflow-x: hidden;
        }

        /* Navbar Glassmorphism */
        .navbar {
            background: rgba(255, 255, 255, 0.8) !important;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0,0,0,0.05);
            padding: 15px 0;
        }

        .navbar-brand {
            font-weight: 800;
            color: var(--primary-orange) !important;
            font-size: 1.5rem;
        }

        .btn-orange {
            background: linear-gradient(135deg, var(--primary-orange), var(--secondary-orange));
            color: white;
            border: none;
            font-weight: 700;
            border-radius: 12px;
            padding: 10px 24px;
            transition: all 0.3s ease;
        }

        .btn-orange:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 107, 53, 0.3);
            color: white;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.7) !important;
            backdrop-filter: blur(15px); /* Efek kaca buram */
            -webkit-backdrop-filter: blur(15px);
            border-bottom: 1px solid rgba(255, 107, 53, 0.1);
        }
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
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link px-3" href="/">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="#daftar-kamar">Cari Kost</a></li>
                    <li class="nav-item ms-lg-3">
                        <a href="/login" class="btn btn-orange">Masuk</a>
                    </li>
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
