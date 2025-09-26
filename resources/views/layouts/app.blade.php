<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        
        .sidebar .nav-link {
            color: #ffffff;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        .sidebar .nav-link:hover {
            background-color: #FFA500; /* Oranye aksen */
            color: #003366;
            font-weight: 600;
        }
        .sidebar .nav-link.active {
            background-color: #FFA500;
            color: #003366;
            font-weight: bold;
        }
        /* Untuk layar kecil, sidebar disembunyikan dulu */
        @media (max-width: 767.98px) {
            .sidebar {
                position: fixed;
                top: 0;
                left: 0;
                height: 100%;
                z-index: 1050;
                transform: translateX(-100%);
            }
            .sidebar.show {
                transform: translateX(0);
            }
            .overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0,0,0,0.5);
                z-index: 1040;
                display: none;
            }
            .overlay.show {
                display: block;
            }
        }
        /* Navbar modern */
.navbar-modern {
    background: linear-gradient(135deg, #6a11cb, #2575fc); /* Ungu → Biru vibrant */
    border: none;
}

/* Sidebar modern */
.sidebar {
    background: linear-gradient(135deg, #6a11cb, #2575fc); /* Sama dengan navbar */
    transition: transform 0.3s ease-in-out;
}

/* Link sidebar */
.sidebar .nav-link {
    color: #ffffff;
    border-radius: 8px;
    transition: all 0.3s ease;
}
.sidebar .nav-link:hover {
    background: rgba(255, 255, 255, 0.2);
    color: #fff;
    font-weight: 600;
}
.sidebar .nav-link.active {
    background: rgba(255, 255, 255, 0.35);
    color: #fff;
    font-weight: bold;
}


/* ✅ Pastikan dropdown user muncul di atas DataTables */
.user-profile .dropdown-menu {
    z-index: 5000 !important;       /* paling atas */
    position: absolute !important;  /* jangan ikut alur container */
    top: 100% !important;           /* tepat di bawah tombol */
    left: 50% !important;           /* tengah */
    transform: translateX(-50%) !important;
}

/* ✅ Supaya DataTables tidak memotong dropdown */
div.dataTables_wrapper {
    overflow: visible !important;
    position: relative !important;  /* biar z-index dropdown bisa jalan */
}

/* ✅ Tambahan agar menu dropdown tidak terlalu mepet */
.user-profile .dropdown-toggle {
    display: inline-flex;
    flex-direction: column;
    align-items: center;
    gap: 5px;
}




    </style>
</head>
<body class="bg-light">

    <!-- ðŸ”¹ Navbar dengan tombol hamburger (hanya di layar kecil) -->
    <nav class="navbar navbar-dark navbar-modern d-md-none shadow-sm">
    <div class="container-fluid">
        <button class="btn btn-outline-light" id="sidebarToggle">
            <i class="bi bi-list fs-4"></i>
        </button>
        <span class="navbar-brand mb-0 h6 fw-bold">Buku Tamu</span>
    </div>
</nav>


    <!-- ðŸ”¹ Overlay untuk mobile -->
    <div class="overlay" id="overlay"></div>

    <div class="d-flex">
        <!-- ðŸ”¹ Sidebar -->
        <!-- 🔹 Sidebar -->
<nav class="sidebar d-flex flex-column flex-shrink-0 p-3 shadow-lg" 
     id="sidebarMenu"
     style="width: 230px; min-height: 100vh;">
    
    <!-- Header Sidebar -->
    <div class="text-center mb-3">
        <i class="bi bi-bar-chart-fill fs-1 text-warning mb-2"></i>
        <h6 class="text-white fw-bold mb-0">Buku Tamu</h6>
        <span class="text-white-50 small">BPS Kota Langsa</span>
    </div>

    <!-- 🔹 Profil Admin di Atas -->
    <!-- 🔹 Profil Admin di Atas -->
<div class="user-profile text-center mb-4">
    @auth
        <!-- Avatar bulat -->
        <div class="bg-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2" 
             style="width: 55px; height: 55px;">
            <i class="bi bi-person text-primary fs-3"></i>
        </div>
        <!-- Nama Admin -->
        <strong class="text-white d-block">{{ Auth::user()->name }}</strong>
        <span class="text-white-50 small">Administrator</span>
    @else
        <div class="d-flex justify-content-center gap-2 mt-2">
            <a href="{{ route('login') }}" class="btn btn-sm btn-outline-light">Login</a>
        </div>
    @endauth
</div>



    <hr class="border-light">

   <!-- Menu -->
<ul class="nav nav-pills flex-column mb-auto">
    <li class="nav-item mb-2">
        <a href="{{ route('dashboard') }}" 
           class="nav-link d-flex align-items-center px-3 py-2 {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-database-fill me-2"></i> <span>Statistik Kunjungan Tamu</span>
        </a>
    </li>
    <li class="nav-item mb-2">
        <a href="{{ route('grafik.index') }}" 
           class="nav-link d-flex align-items-center px-3 py-2 {{ request()->routeIs('grafik.index') ? 'active' : '' }}">
            <i class="bi bi-graph-up-arrow me-2"></i> <span>Statistik Kunjungan PST </span>
        </a>
    </li>
    <li class="nav-item mb-2">
        <a href="{{ route('laporan.index') }}" 
           class="nav-link d-flex align-items-center px-3 py-2 {{ request()->routeIs('laporan.index') ? 'active' : '' }}">
            <i class="bi bi-file-earmark-text-fill me-2"></i> <span>Laporan</span>
        </a>
    </li>

    @auth
    <li class="nav-item">
        <a href="{{ route('admin.register') }}" 
           class="nav-link d-flex align-items-center px-3 py-2 {{ request()->routeIs('admin.register') ? 'active' : '' }}">
            <i class="bi bi-person-plus-fill me-2"></i> <span>Register Admin</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.index') }}" 
           class="nav-link d-flex align-items-center px-3 py-2 {{ request()->routeIs('admin.index') ? 'active' : '' }}">
            <i class="bi bi-people-fill me-2"></i> <span>Database Admin</span>
        </a>
    </li>

    <!-- 🔹 Tombol Logout Langsung -->
    <li class="nav-item mt-3">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-danger w-100 d-flex align-items-center justify-content-center">
                <i class="bi bi-box-arrow-right me-2"></i> Logout
            </button>
        </form>
    </li>
    @endauth
</ul>

</nav>


        <!-- ðŸ”¹ Main Content -->
        <div class="flex-grow-1 p-4">
            {{ $slot ?? '' }}
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- ðŸ”¹ Script toggle sidebar -->
    <script>
        const sidebar = document.getElementById('sidebarMenu');
        const toggleBtn = document.getElementById('sidebarToggle');
        const overlay = document.getElementById('overlay');

        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('show');
            overlay.classList.toggle('show');
        });

        overlay.addEventListener('click', () => {
            sidebar.classList.remove('show');
            overlay.classList.remove('show');
        });
    </script>
</body>
</html>