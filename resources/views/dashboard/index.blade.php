<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>PinTa - Marketplace</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            background: #f8fafc;
            color: #334155;
        }

        /* NAVBAR */
        .navbar {
            background: white;
            padding: 18px 7%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 8px rgba(0,0,0,.05);
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .logo {
            font-size: 27px;
            font-weight: bold;
            color: #2563eb;
        }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .nav-menu a {
            color: #334155;
            text-decoration: none;
            font-size: 14px;
        }

        .nav-menu a:hover {
            color: #2563eb;
        }

        .btn {
            padding: 11px 17px;
            border: none;
            border-radius: 7px;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
            display: inline-block;
        }

        .btn-primary {
            background: #2563eb;
            color: white !important;
        }

        .btn-primary:hover {
            background: #1d4ed8;
        }

        .btn-outline {
            border: 1px solid #2563eb;
            color: #2563eb !important;
            background: white;
        }

        .btn-danger {
            background: #dc2626;
            color: white;
        }

        /* USER MENU */
        .user-info {
            font-size: 13px;
            color: #64748b;
        }

        /* ALERT */
        .alert-success {
            margin: 20px 7% 0;
            padding: 13px 17px;
            background: #dcfce7;
            color: #166534;
            border-radius: 7px;
            font-size: 14px;
        }

        /* HERO */
        .hero {
            padding: 75px 7%;
            background: linear-gradient(120deg, #dbeafe, #eff6ff);
        }

        .hero h1 {
            color: #1e3a8a;
            font-size: 38px;
            margin-bottom: 17px;
        }

        .hero p {
            color: #475569;
            max-width: 550px;
            line-height: 1.7;
            margin-bottom: 25px;
            font-size: 15px;
        }

        /* CONTENT */
        .container {
            padding: 50px 7%;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .section-header h2 {
            color: #1e293b;
            font-size: 25px;
        }

        /* PRODUCT */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 22px;
        }

        .product-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,.05);
            transition: .2s;
        }

        .product-card:hover {
            transform: translateY(-4px);
        }

        .product-image {
            height: 180px;
            background: #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
            font-size: 14px;
        }

        .product-info {
            padding: 17px;
        }

        .product-info h3 {
            font-size: 16px;
            color: #1e293b;
            margin-bottom: 10px;
        }

        .price {
            color: #2563eb;
            font-weight: bold;
            margin-bottom: 17px;
            font-size: 15px;
        }

        .product-info .btn {
            width: 100%;
            text-align: center;
        }

        /* FOOTER */
        footer {
            background: #1e293b;
            color: white;
            text-align: center;
            padding: 35px 7%;
            margin-top: 30px;
        }

        footer p {
            font-size: 13px;
            color: #cbd5e1;
            margin-top: 10px;
        }

        /* RESPONSIVE */
        @media(max-width: 1000px) {
            .product-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media(max-width: 650px) {
            .navbar {
                flex-direction: column;
                gap: 17px;
            }

            .nav-menu {
                flex-wrap: wrap;
                justify-content: center;
                gap: 12px;
            }

            .hero h1 {
                font-size: 28px;
            }

            .product-grid {
                grid-template-columns: 1fr;
            }

            .section-header h2 {
                font-size: 21px;
            }
        }
    </style>

</head>

<body>

    {{-- NAVBAR --}}
    <nav class="navbar">

        <div class="logo">
            PinTa
        </div>

        <div class="nav-menu">

            <a href="{{ route('dashboard') }}">
                Beranda
            </a>

            <a href="#produk">
                Produk
            </a>

            @auth

                {{-- MENU KHUSUS PEMBELI --}}
                @if (auth()->user()->hasRole('pembeli'))

                    <a href="#">
                        Pesanan Saya
                    </a>

                    {{-- Hanya pembeli yang belum menjadi penjual --}}
                    @if (!auth()->user()->hasRole('penjual'))

                        <a href="#">
                            Daftar sebagai Penjual
                        </a>

                    @endif

                @endif

                {{-- MENU ADMIN --}}
                @if (auth()->user()->hasRole('admin'))

                    <a href="{{ route('admin.dashboard') }}">
                        Dashboard Admin
                    </a>

                @endif

                {{-- MENU PENJUAL --}}
                @if (auth()->user()->hasRole('penjual'))

                    <a href="{{ route('seller.dashboard') }}">
                        Dashboard Penjual
                    </a>

                @endif

                <span class="user-info">
                    Halo, <strong>{{ auth()->user()->name }}</strong>
                </span>

                <form action="{{ route('logout') }}" method="POST">

                    @csrf

                    <button type="submit" class="btn btn-danger">
                        Logout
                    </button>

                </form>

            @else

                {{-- MENU GUEST --}}
                <a href="{{ route('login') }}">
                    Login
                </a>

                <a href="{{ route('register') }}" class="btn btn-primary">
                    Daftar
                </a>

            @endauth

        </div>

    </nav>


    {{-- SUCCESS MESSAGE --}}
    @if (session('success'))

        <div class="alert-success">
            {{ session('success') }}
        </div>

    @endif


    {{-- HERO SECTION --}}
    <section class="hero">

        <h1>
            Selamat Datang di PinTa!
        </h1>

        <p>
            Temukan berbagai produk menarik dengan mudah,
            aman, dan nyaman melalui marketplace PinTa.
        </p>

        <a href="#produk" class="btn btn-primary">
            Jelajahi Produk
        </a>

    </section>


    {{-- PRODUCT SECTION --}}
    <main class="container" id="produk">

        <div class="section-header">

            <h2>Produk Terbaru</h2>

        </div>

        @php
            // Data produk sementara
            $products = [
                [
                    'name' => 'Produk Contoh 1',
                    'price' => 50000,
                ],
                [
                    'name' => 'Produk Contoh 2',
                    'price' => 75000,
                ],
                [
                    'name' => 'Produk Contoh 3',
                    'price' => 100000,
                ],
                [
                    'name' => 'Produk Contoh 4',
                    'price' => 125000,
                ],
            ];
        @endphp

        <div class="product-grid">

            @foreach ($products as $product)

                <div class="product-card">

                    <div class="product-image">
                        Gambar Produk
                    </div>

                    <div class="product-info">

                        <h3>
                            {{ $product['name'] }}
                        </h3>

                        <p class="price">
                            Rp {{ number_format($product['price'], 0, ',', '.') }}
                        </p>

                        @auth

                            {{-- PEMBELI DAN PENJUAL --}}
                            @if (auth()->user()->hasRole('pembeli'))

                                <a href="{{ route('checkout') }}"
                                   class="btn btn-primary">
                                    Checkout
                                </a>

                            @endif

                        @else

                            {{-- GUEST --}}
                            <a href="{{ route('login') }}"
                               class="btn btn-outline">
                                Login untuk Checkout
                            </a>

                        @endauth

                    </div>

                </div>

            @endforeach

        </div>

    </main>


    {{-- FOOTER --}}
    <footer>

        <h3>PinTa Marketplace</h3>

        <p>
            Platform marketplace untuk kebutuhan belanja Anda.
        </p>

        <br>

        <small>
            &copy; {{ date('Y') }} PinTa. All Rights Reserved.
        </small>

    </footer>

</body>

</html>