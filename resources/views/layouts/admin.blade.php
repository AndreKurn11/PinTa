<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Admin Dashboard') - PinTa</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            background: #f1f5f9;
            color: #334155;
        }

        /* SIDEBAR */
        .sidebar {
            position: fixed;
            width: 250px;
            height: 100vh;
            background: #1e293b;
            color: white;
            padding: 25px 18px;
            display: flex;
            flex-direction: column;
        }

        .sidebar-logo {
            font-size: 27px;
            font-weight: bold;
            color: #60a5fa;
            margin-bottom: 35px;
            padding-left: 10px;
        }

        .sidebar-menu {
            list-style: none;
            flex: 1;
        }

        .sidebar-menu li {
            margin-bottom: 8px;
        }

        .sidebar-menu a {
            display: block;
            color: #cbd5e1;
            text-decoration: none;
            padding: 13px 12px;
            border-radius: 7px;
            font-size: 14px;
            transition: 0.2s;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: #2563eb;
            color: white;
        }

        .sidebar-bottom {
            border-top: 1px solid #475569;
            padding-top: 18px;
        }

        .sidebar-bottom a {
            color: #cbd5e1;
            text-decoration: none;
            font-size: 14px;
        }

        /* MAIN */
        .main-content {
            margin-left: 250px;
            min-height: 100vh;
        }

        /* TOPBAR */
        .topbar {
            background: white;
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 8px rgba(0,0,0,.04);
        }

        .topbar h2 {
            font-size: 19px;
            color: #1e293b;
        }

        .admin-info {
            font-size: 14px;
            color: #64748b;
        }

        /* CONTENT */
        .content {
            padding: 30px;
        }

        .page-title {
            margin-bottom: 25px;
        }

        .page-title h1 {
            font-size: 25px;
            color: #1e293b;
            margin-bottom: 8px;
        }

        .page-title p {
            color: #64748b;
            font-size: 14px;
        }

        /* RESPONSIVE */
        @media(max-width: 768px) {
            .sidebar {
                width: 190px;
            }

            .main-content {
                margin-left: 190px;
            }

            .content {
                padding: 20px 15px;
            }
        }

        @media(max-width: 550px) {
            .sidebar {
                width: 65px;
                padding: 20px 8px;
            }

            .sidebar-logo {
                font-size: 18px;
                text-align: center;
                padding: 0;
            }

            .sidebar-menu a {
                font-size: 0;
                text-align: center;
                padding: 13px 3px;
            }

            .sidebar-menu a::first-letter {
                font-size: 14px;
            }

            .sidebar-bottom {
                text-align: center;
            }

            .sidebar-bottom a {
                font-size: 0;
            }

            .sidebar-bottom a::first-letter {
                font-size: 14px;
            }

            .main-content {
                margin-left: 65px;
            }

            .topbar {
                padding: 17px 12px;
                flex-wrap: wrap;
                gap: 10px;
            }

            .topbar h2 {
                font-size: 15px;
            }

            .admin-info {
                font-size: 12px;
            }
        }
    </style>

    @yield('styles')

</head>

<body>

    {{-- SIDEBAR --}}
    <aside class="sidebar">

        <div class="sidebar-logo">
            PinTa
        </div>

        <ul class="sidebar-menu">

            <li>
                <a href="{{ route('admin.dashboard') }}"
                   class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    🏠 Dashboard
                </a>
            </li>

            <li>
                <a href="#">
                    👥 Manajemen Pengguna
                </a>
            </li>

            <li>
              <a href="{{ route('admin.seller-registrations.index') }}">
                  Kelola Pendaftaran Penjual
              </a>
            </li>

            <li>
                <a href="#">
                    🛍️ Manajemen Produk
                </a>
            </li>

            <li>
                <a href="#">
                    📦 Manajemen Pesanan
                </a>
            </li>

            <li>
                <a href="#">
                    🏪 Pendaftaran Penjual
                </a>
            </li>

        </ul>

        <div class="sidebar-bottom">

            <a href="{{ route('dashboard') }}">
                ← Kembali ke Marketplace
            </a>

            <br><br>

            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button type="submit"
                    style="background:none; border:none; color:#fca5a5; cursor:pointer;">
                    Logout
                </button>
            </form>

        </div>

    </aside>


    {{-- MAIN CONTENT --}}
    <main class="main-content">

        {{-- TOPBAR --}}
        <header class="topbar">

            <h2>@yield('page-heading', 'Dashboard Administrator')</h2>

            <div class="admin-info">
                Admin: <strong>{{ auth()->user()->name }}</strong>
            </div>

        </header>

        {{-- PAGE CONTENT --}}
        <section class="content">

            @yield('content')

        </section>

    </main>

    @yield('scripts')

</body>
</html>