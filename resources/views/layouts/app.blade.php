<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>@yield('title','App')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">


    <style>
        body {
            overflow-x: hidden;
            background: #f7f7f7;
        }

        /* SIDEBAR BASE DESIGN */
        .sidebar {
            width: 200px;
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            background: #212529;
            padding-top: 60px;
            transition: all 0.3s ease;
            z-index: 2000;
        }

        /* SIDEBAR COLLAPSED (DESKTOP) */
        .sidebar.collapsed {
            width: 70px;
        }

        /* SIDEBAR MOBILE (START HIDDEN) */
        @media (max-width: 991px) {
            .sidebar {
                left: -240px;
            }

            .sidebar.mobile-open {
                left: 0;
            }
        }

        /* SIDEBAR MENU ITEMS */
        .sidebar a {
            padding: 12px 20px;
            display: flex;
            align-items: center;
            color: #ffffffcc;
            text-decoration: none;
            font-size: 15px;
            white-space: nowrap;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background: #343a40;
            color: #fff;
        }

        .sidebar i {
            font-size: 19px;
            margin-right: 15px;
        }

        .sidebar.collapsed a span {
            display: none;
        }

        /* NAVBAR */
        .navbar {
            margin-left: 200px;
            transition: all 0.3s ease;
            z-index: 3000 !important;
        }

        .navbar.collapsed {
            margin-left: 70px;
        }

        @media (max-width: 991px) {
            .navbar {
                margin-left: 0 !important;
            }
        }

        .logo-img {
            height: 38px;
        }

        /* CONTENT AREA */
        .content-auth {
            margin-left: 240px;
            padding: 20px;
            margin-top: 60px;
            transition: all 0.3s ease;
        }

        .content-auth.collapsed {
            margin-left: 70px;
        }

        @media (max-width: 991px) {
            .content-auth {
                margin-left: 0 !important;
            }
        }

        .swal2-container.swal2-top-end {
            top: 70px !important;
        }
    </style>
</head>

<body>

    @auth

    <!-- NAVBAR -->
    <nav class="navbar navbar-dark bg-dark fixed-top">
        <div class="container-fluid d-flex align-items-center">

            <!-- Sidebar Toggle Button -->
            <button id="toggleSidebar" class="btn btn-outline-light btn-sm me-3 d-lg-none">
                <i class="bi bi-list"></i>
            </button>

            <!-- Desktop Collapse Button -->
            <button id="collapseSidebar" class="btn btn-outline-light btn-sm me-3 d-none d-lg-block">
                <i class="bi bi-chevron-double-left"></i>
            </button>

            <!-- Logo -->
            <img src="{{ asset('assets/images/cnamelogo.png') }}" class="logo-img me-3">

            <span class="navbar-brand mb-0 h1">Laravel App</span>

            <div class="ms-auto d-flex align-items-center">
                <span class="text-white me-3">Hello, {{ auth()->user()->first_name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-danger btn-sm">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- SIDEBAR -->
    <div id="sidebar" class="sidebar">
        <a href="{{ route('dashboard') }}">
            <i class="bi bi-speedometer2"></i>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('users.index') }}">
            <i class="bi bi-people"></i>
            <span>Manage Users</span>
        </a>

        <a href="#">
            <i class="bi bi-qr-code-scan"></i>
            <span>Scan Log</span>
        </a>
    </div>

    <!-- CONTENT -->
    <div id="content" class="content-auth">
        @yield('content')
    </div>

    @endauth


    @guest
    <div class="content-guest p-3 mt-5">
        @yield('content')
    </div>
    @endguest

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

    <!-- JS LOGIC -->
    <script>
        function showToast(message, type = 'success') {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: type,
                title: message,
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
            });
        }

        const sidebar = document.getElementById("sidebar");
        const content = document.getElementById("content");
        const navbar = document.querySelector(".navbar");

        const toggleSidebar = document.getElementById("toggleSidebar");
        const collapseSidebar = document.getElementById("collapseSidebar");

        // MOBILE TOGGLE
        toggleSidebar?.addEventListener("click", () => {
            sidebar.classList.toggle("mobile-open");
        });

        /// DESKTOP COLLAPSE TOGGLE WITH ICON CHANGE
        collapseSidebar?.addEventListener("click", () => {
            sidebar.classList.toggle("collapsed");
            content.classList.toggle("collapsed");
            navbar.classList.toggle("collapsed");

            // Change icon dynamically
            const icon = collapseSidebar.querySelector("i");

            if (sidebar.classList.contains("collapsed")) {
                icon.classList.remove("bi-chevron-double-left");
                icon.classList.add("bi-chevron-double-right");
            } else {
                icon.classList.remove("bi-chevron-double-right");
                icon.classList.add("bi-chevron-double-left");
            }
        });
    </script>

</body>

</html>