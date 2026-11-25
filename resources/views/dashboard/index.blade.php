<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PinTa - Marketplace Mahasiswa</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,400,0,0" rel="stylesheet">
    <style>
        :root {
            --primary: #9a5b3d;
            --primary-dark: #75432f;
            --primary-soft: #f5e9e2;
            --surface: #fff;
            --page: #f7f6f4;
            --text: #292521;
            --muted: #827b75;
            --line: #ebe7e3;
            --green: #287a55;
            --shadow: 0 8px 28px rgba(47, 36, 28, .06);
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body { background: var(--page); color: var(--text); font-family: 'DM Sans', sans-serif; }
        a { color: inherit; text-decoration: none; }
        button, input { font: inherit; }
        .topbar {
            position: sticky; top: 0; z-index: 20; height: 76px;
            background: rgba(255,255,255,.88); backdrop-filter: blur(18px);
            border-bottom: 1px solid var(--line);
        }
        .nav-inner {
            max-width: 1280px; height: 100%; margin: auto; padding: 0 28px;
            display: flex; align-items: center; justify-content: space-between; gap: 24px;
        }
        .brand { display: flex; align-items: center; gap: 11px; flex-shrink: 0; }
        .brand-mark {
            width: 42px; height: 42px; display: grid; place-items: center;
            border-radius: 13px; background: var(--primary); color: white;
            font: 800 21px 'Plus Jakarta Sans'; box-shadow: 0 5px 12px #9a5b3d30;
        }
        .brand-name { font: 800 20px 'Plus Jakarta Sans'; letter-spacing: -.7px; }
        .brand-tag { margin-left: 5px; padding: 3px 7px; border-radius: 6px; background: var(--primary-soft); color: var(--primary); font-size: 10px; font-weight: 700; text-transform: uppercase; }
        .brand-sub { color: var(--muted); font-size: 11px; margin-top: 2px; }
        .location-pill { display: flex; align-items: center; gap: 7px; padding: 9px 12px; border: 1px solid var(--line); border-radius: 30px; background: #faf9f8; color: #625b55; font-size: 12px; white-space: nowrap; }
        .material-symbols-outlined { font-size: 20px; vertical-align: middle; }
        .search-wrap { flex: 1; max-width: 470px; position: relative; }
        .search-wrap .material-symbols-outlined { position: absolute; left: 14px; top: 11px; color: #938b84; }
        .search-wrap input { width: 100%; padding: 12px 16px 12px 43px; border: 1px solid transparent; border-radius: 30px; outline: none; background: #f2f0ee; color: var(--text); font-size: 13px; }
        .search-wrap input:focus { background: white; border-color: #cda995; box-shadow: 0 0 0 4px #9a5b3d12; }
        .nav-actions { display: flex; align-items: center; gap: 10px; flex-shrink: 0; }
        .nav-link { font-size: 13px; font-weight: 600; color: #625b55; padding: 9px 8px; }
        .nav-link:hover { color: var(--primary); }
        .btn { display: inline-flex; align-items: center; justify-content: center; gap: 7px; padding: 11px 17px; border: 0; border-radius: 30px; cursor: pointer; font-size: 13px; font-weight: 700; transition: .2s; }
        .btn-primary { color: white; background: var(--primary); box-shadow: 0 4px 12px #9a5b3d25; }
        .btn-primary:hover { background: var(--primary-dark); transform: translateY(-1px); }
        .btn-outline { color: var(--primary); background: white; border: 1px solid #d9c1b4; }
        .btn-danger { color: #b42318; background: #fff1ef; padding: 9px 13px; }
        .user-name { font-size: 12px; color: var(--muted); white-space: nowrap; }
        .user-name strong { color: var(--text); }
        .logout-form { display: inline; }
        .page { max-width: 1280px; margin: auto; padding: 30px 28px 60px; }
        .alert-success { margin-bottom: 20px; padding: 13px 16px; border: 1px solid #b7dfc8; border-radius: 12px; background: #effaf3; color: #216b43; font-size: 13px; }
        .hero {
            position: relative; overflow: hidden; border-radius: 22px; padding: 42px;
            color: white; background: linear-gradient(118deg, #75432f 0%, #9a5b3d 58%, #b77b5d 100%);
            box-shadow: 0 12px 32px #75432f20;
        }
        .hero:after { content: ""; position: absolute; width: 360px; height: 360px; right: -80px; top: -170px; border: 1px solid #ffffff25; border-radius: 50%; box-shadow: 0 0 0 35px #ffffff0b, 0 0 0 75px #ffffff08; }
        .hero-grid { position: relative; z-index: 1; display: grid; grid-template-columns: 1.4fr .8fr; align-items: center; gap: 35px; }
        .eyebrow { display: inline-flex; align-items: center; gap: 7px; padding: 7px 11px; border: 1px solid #ffffff30; border-radius: 30px; background: #00000020; font-size: 11px; font-weight: 700; }
        .eyebrow .material-symbols-outlined { color: #b8f0c9; font-size: 16px; }
        .hero h1 { max-width: 660px; margin: 17px 0 13px; font: 800 clamp(28px, 3.6vw, 43px)/1.16 'Plus Jakarta Sans'; letter-spacing: -1.5px; }
        .hero p { max-width: 620px; color: #fff2ec; font-size: 14px; line-height: 1.8; }
        .hero-cta { display: flex; align-items: center; flex-wrap: wrap; gap: 11px; margin-top: 23px; }
        .hero .btn-light { color: var(--primary-dark); background: white; }
        .safe-note { display: inline-flex; align-items: center; gap: 7px; padding: 10px 13px; border: 1px solid #ffffff35; border-radius: 30px; background: #00000020; font-size: 11px; }
        .campus-card { padding: 20px; border: 1px solid #ffffff50; border-radius: 17px; background: white; color: var(--text); box-shadow: 0 12px 30px #43271930; }
        .campus-head { display: flex; align-items: center; justify-content: space-between; gap: 12px; padding-bottom: 14px; border-bottom: 1px solid var(--line); }
        .campus-title { display: flex; align-items: center; gap: 10px; }
        .campus-icon { width: 38px; height: 38px; display: grid; place-items: center; border-radius: 11px; color: var(--primary); background: var(--primary-soft); }
        .campus-title small { display: block; color: var(--muted); font-size: 10px; font-weight: 700; text-transform: uppercase; }
        .campus-title strong { display: block; margin-top: 3px; font-size: 13px; }
        .live { padding: 5px 9px; border-radius: 20px; color: var(--green); background: #eaf7ef; font-size: 10px; font-weight: 700; }
        .metrics { display: grid; grid-template-columns: repeat(3,1fr); gap: 8px; padding: 14px 0; text-align: center; }
        .metric { padding: 10px 4px; border-radius: 10px; background: #f7f5f3; }
        .metric strong { display: block; color: var(--primary); font: 800 20px 'Plus Jakarta Sans'; }
        .metric span { display: block; margin-top: 3px; color: var(--muted); font-size: 10px; }
        .campus-foot { color: var(--muted); text-align: center; font-size: 11px; line-height: 1.6; }
        .section { margin-top: 32px; }
        .section-heading { display: flex; align-items: end; justify-content: space-between; gap: 15px; margin-bottom: 15px; }
        .section-heading h2 { font: 800 19px 'Plus Jakarta Sans'; letter-spacing: -.4px; }
        .section-heading p { margin-top: 4px; color: var(--muted); font-size: 12px; }
        .text-link { color: var(--primary); font-size: 12px; font-weight: 700; }
        .category-grid { display: grid; grid-template-columns: repeat(5,1fr); gap: 11px; }
        .category { display: flex; align-items: center; gap: 11px; min-width: 0; padding: 14px 12px; border: 1px solid var(--line); border-radius: 14px; background: white; box-shadow: 0 4px 16px #30251c08; transition: .2s; }
        .category:hover { transform: translateY(-2px); border-color: #d7b9a9; }
        .category-icon { width: 42px; height: 42px; display: grid; place-items: center; flex-shrink: 0; border-radius: 12px; color: var(--primary); background: var(--primary-soft); }
        .category strong { display: block; overflow: hidden; font-size: 12px; text-overflow: ellipsis; white-space: nowrap; }
        .category small { display: block; margin-top: 4px; color: var(--muted); font-size: 10px; }
        .catalog-layout { display: grid; grid-template-columns: 245px minmax(0,1fr); gap: 20px; align-items: start; }
        .filter-card, .product-card { border: 1px solid var(--line); border-radius: 16px; background: white; box-shadow: var(--shadow); }
        .filter-card { padding: 17px; }
        .filter-head { display: flex; align-items: center; justify-content: space-between; padding-bottom: 13px; border-bottom: 1px solid var(--line); }
        .filter-head h3 { font: 700 14px 'Plus Jakarta Sans'; }
        .reset { border: 0; background: none; color: var(--primary); font-size: 11px; font-weight: 700; cursor: pointer; }
        .filter-group { padding-top: 15px; }
        .filter-label { display: block; margin-bottom: 9px; color: var(--muted); font-size: 10px; font-weight: 700; letter-spacing: .8px; text-transform: uppercase; }
        .filter-option { display: flex; align-items: center; gap: 8px; padding: 7px 2px; color: #5f5852; font-size: 12px; }
        .filter-option input { accent-color: var(--primary); }
        .filter-option span:last-child { margin-left: auto; color: #9a928b; font-size: 10px; }
        .tip-card { margin-top: 12px; padding: 15px; border-radius: 14px; background: #f5e9e2; color: #704630; }
        .tip-card strong { font-size: 12px; }
        .tip-card p { margin-top: 6px; font-size: 11px; line-height: 1.6; }
        .listing-head { display: flex; align-items: center; justify-content: space-between; gap: 15px; margin-bottom: 14px; }
        .listing-head h2 { font: 800 19px 'Plus Jakarta Sans'; }
        .listing-head p { margin-top: 4px; color: var(--muted); font-size: 12px; }
        .sort-select { padding: 9px 12px; border: 1px solid var(--line); border-radius: 10px; background: white; color: #625b55; font-size: 11px; }
        .product-grid { display: grid; grid-template-columns: repeat(3,minmax(0,1fr)); gap: 15px; }
        .product-card { overflow: hidden; transition: .2s; }
        .product-card:hover { transform: translateY(-3px); box-shadow: 0 12px 28px #30251c12; }
        .product-image { height: 175px; display: grid; place-items: center; background: linear-gradient(135deg,#f1ece7,#e8dfd8); color: #9a8d82; font-size: 12px; }
        .product-image .material-symbols-outlined { font-size: 38px; }
        .product-info { padding: 14px; }
        .product-meta { display: flex; justify-content: space-between; align-items: center; gap: 8px; margin-bottom: 9px; }
        .product-tag { padding: 4px 7px; border-radius: 20px; background: var(--primary-soft); color: var(--primary); font-size: 9px; font-weight: 700; }
        .product-location { color: var(--muted); font-size: 10px; }
        .product-info h3 { min-height: 38px; font-size: 13px; line-height: 1.45; }
        .price { margin: 9px 0 13px; color: var(--primary); font: 800 15px 'Plus Jakarta Sans'; }
        .product-info .btn { width: 100%; border-radius: 10px; padding: 10px; }
        footer { margin-top: 40px; padding: 30px 20px; background: #302923; color: white; text-align: center; }
        footer p { margin-top: 7px; color: #c8beb6; font-size: 12px; }
        footer small { display: block; margin-top: 18px; color: #a99e95; font-size: 10px; }
        @media(max-width: 1050px) {
            .location-pill { display: none; }
            .category-grid { grid-template-columns: repeat(3,1fr); }
            .product-grid { grid-template-columns: repeat(2,minmax(0,1fr)); }
        }
        @media(max-width: 760px) {
            .topbar { height: auto; }
            .nav-inner { padding: 13px 18px; flex-wrap: wrap; gap: 12px; }
            .brand { flex: 1; }
            .search-wrap { order: 3; flex-basis: 100%; max-width: none; }
            .nav-actions { gap: 5px; }
            .nav-link { padding: 7px 5px; font-size: 11px; }
            .user-name { display: none; }
            .page { padding: 20px 16px 45px; }
            .hero { padding: 27px 22px; border-radius: 17px; }
            .hero-grid { grid-template-columns: 1fr; gap: 24px; }
            .hero h1 { font-size: 30px; }
            .campus-card { max-width: 440px; }
            .category-grid { grid-template-columns: repeat(2,minmax(0,1fr)); }
            .catalog-layout { grid-template-columns: 1fr; }
            .filter-card { display: none; }
        }
        @media(max-width: 480px) {
            .brand-sub { display: none; }
            .brand-name { font-size: 18px; }
            .nav-actions { width: 100%; justify-content: space-between; }
            .nav-actions .btn { padding: 9px 12px; }
            .hero h1 { font-size: 26px; }
            .hero p { font-size: 12px; }
            .safe-note { font-size: 10px; }
            .category { padding: 11px 9px; gap: 8px; }
            .category-icon { width: 36px; height: 36px; }
            .category strong { font-size: 11px; }
            .category small { font-size: 9px; }
            .product-grid { grid-template-columns: 1fr 1fr; gap: 10px; }
            .product-image { height: 125px; }
            .product-info { padding: 10px; }
            .product-info h3 { font-size: 11px; }
            .price { font-size: 12px; }
            .product-info .btn { font-size: 10px; padding: 9px 5px; }
            .listing-head h2 { font-size: 16px; }
            .sort-select { max-width: 115px; }
        }
    </style>
</head>
<body>

    {{-- NAVBAR --}}
    <header class="topbar">
        <div class="nav-inner">
            <a href="{{ route('dashboard') }}" class="brand">
                <div class="brand-mark">P</div>
                <div>
                    <div><span class="brand-name">PINTA</span><span class="brand-tag">Jambi</span></div>
                    <p class="brand-sub">Pindah Tangan Mahasiswa</p>
                </div>
            </a>

            <div class="location-pill">
                <span class="material-symbols-outlined">location_on</span>
                <span>UNJA Mendalo, Jambi</span>
            </div>

            <form action="#produk" method="GET" class="search-wrap">
                <span class="material-symbols-outlined">search</span>
                <input type="search" name="q" value="{{ request('q') }}" placeholder="Cari buku kuliah, laptop, perlengkapan kos...">
            </form>

            <nav class="nav-actions">
                <a href="{{ route('dashboard') }}" class="nav-link">Beranda</a>
                <a href="#produk" class="nav-link">Katalog</a>

                @auth
                    @if (auth()->user()->hasRole('pembeli'))
                        <a href="#" class="nav-link">Pesanan Saya</a>
                        @if (!auth()->user()->hasRole('penjual'))
                            <a href="{{ route('seller.register') }}" class="nav-link">Daftar Penjual</a>
                        @endif
                    @endif

                    @if (auth()->user()->hasRole('admin'))
                        <a href="{{ route('admin.dashboard') }}" class="nav-link">Dashboard Admin</a>
                    @endif

                    @if (auth()->user()->hasRole('penjual'))
                        <a href="{{ route('seller.dashboard') }}" class="nav-link">Dashboard Penjual</a>
                    @endif

                    <span class="user-name">Halo, <strong>{{ auth()->user()->name }}</strong></span>
                    <form action="{{ route('logout') }}" method="POST" class="logout-form">
                        @csrf
                        <button type="submit" class="btn btn-danger">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="nav-link">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-primary">Daftar</a>
                @endauth
            </nav>
        </div>
    </header>

    <main class="page">
        @if (session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        {{-- HERO --}}
        <section class="hero">
            <div class="hero-grid">
                <div>
                    <div class="eyebrow">
                        <span class="material-symbols-outlined">verified</span>
                        Ekosistem Mahasiswa Terverifikasi
                    </div>
                    <h1>Pindah Tangan Lebih Berkah, Hemat Ongkos di Kota Jambi.</h1>
                    <p>Jual perlengkapan kos, temukan buku kuliah, barter kebutuhan semester, atau ikuti lelang bersama komunitas mahasiswa.</p>
                    <div class="hero-cta">
                        <a href="#produk" class="btn btn-light">Mulai Jelajahi <span class="material-symbols-outlined">arrow_forward</span></a>
                        <span class="safe-note"><span class="material-symbols-outlined">shield</span> Transaksi nyaman sesama mahasiswa</span>
                    </div>
                </div>
                <div class="campus-card">
                    <div class="campus-head">
                        <div class="campus-title">
                            <div class="campus-icon"><span class="material-symbols-outlined">school</span></div>
                            <div><small>Komunitas kampus</small><strong>Pasar Mahasiswa Jambi</strong></div>
                        </div>
                        <span class="live">● Marketplace</span>
                    </div>
                    <div class="metrics">
                        <div class="metric"><strong>Jual</strong><span>Barang bekas</span></div>
                        <div class="metric"><strong>Barter</strong><span>Tukar barang</span></div>
                        <div class="metric"><strong>Lelang</strong><span>Penawaran</span></div>
                    </div>
                    <p class="campus-foot">Satu tempat untuk jual beli, barter, dan lelang kebutuhan mahasiswa.</p>
                </div>
            </div>
        </section>

        {{-- KATEGORI PILIHAN --}}
        <section class="section">
            <div class="section-heading">
                <div><h2>Kategori Pilihan Mahasiswa</h2><p>Temukan barang yang kamu butuhkan lebih cepat.</p></div>
                <a href="#produk" class="text-link">Lihat katalog →</a>
            </div>
            <div class="category-grid">
                <a href="#produk" class="category"><div class="category-icon"><span class="material-symbols-outlined">menu_book</span></div><div><strong>Buku Kuliah</strong><small>Diktat, modul, jurnal</small></div></a>
                <a href="#produk" class="category"><div class="category-icon"><span class="material-symbols-outlined">laptop_mac</span></div><div><strong>Elektronik</strong><small>Laptop, tablet, kalkulator</small></div></a>
                <a href="#produk" class="category"><div class="category-icon"><span class="material-symbols-outlined">checkroom</span></div><div><strong>Pakaian</strong><small>Kemeja, jaket, lainnya</small></div></a>
                <a href="#produk" class="category"><div class="category-icon"><span class="material-symbols-outlined">steps</span></div><div><strong>Sepatu</strong><small>Sneakers, sepatu formal</small></div></a>
                <a href="#produk" class="category"><div class="category-icon"><span class="material-symbols-outlined">chair</span></div><div><strong>Furnitur Kos</strong><small>Meja, rak, perlengkapan</small></div></a>
            </div>
        </section>

        {{-- PRODUK --}}
        <section class="section" id="produk">
            <div class="catalog-layout">
                <aside>
                    <div class="filter-card">
                        <div class="filter-head"><h3>Filter Pencarian</h3><button type="reset" class="reset" onclick="document.querySelectorAll('.filter-card input').forEach(el => el.checked = false)">Reset</button></div>
                        <div class="filter-group">
                            <span class="filter-label">Mode Transaksi</span>
                            <label class="filter-option"><input type="checkbox" checked> Semua Mode <span>—</span></label>
                            <label class="filter-option"><input type="checkbox"> Jual Beli <span>—</span></label>
                            <label class="filter-option"><input type="checkbox"> Barter <span>—</span></label>
                            <label class="filter-option"><input type="checkbox"> Lelang <span>—</span></label>
                        </div>
                        <div class="tip-card">
                            <strong>Tips transaksi aman</strong>
                            <p>Periksa kondisi barang dan sepakati lokasi COD yang ramai sebelum bertransaksi.</p>
                        </div>
                    </div>
                </aside>

                <div>
                    <div class="listing-head">
                        <div><h2>Produk Terbaru</h2><p>Barang pilihan dari komunitas PinTa.</p></div>
                        <select class="sort-select" aria-label="Urutkan produk">
                            <option>Terbaru</option>
                            <option>Harga terendah</option>
                            <option>Harga tertinggi</option>
                        </select>
                    </div>

                    @php
                        // Data produk sementara. Nantinya dapat diganti dengan data dari database.
                        $products = [
                            ['name' => 'Produk Contoh 1', 'price' => 50000],
                            ['name' => 'Produk Contoh 2', 'price' => 75000],
                            ['name' => 'Produk Contoh 3', 'price' => 100000],
                            ['name' => 'Produk Contoh 4', 'price' => 125000],
                        ];
                    @endphp

                    <div class="product-grid">
                        @foreach ($products as $product)
                            <article class="product-card">
                                <div class="product-image">
                                    <div><span class="material-symbols-outlined">inventory_2</span><br>Foto Produk</div>
                                </div>
                                <div class="product-info">
                                    <div class="product-meta"><span class="product-tag">JUAL BELI</span><span class="product-location">Jambi</span></div>
                                    <h3>{{ $product['name'] }}</h3>
                                    <p class="price">Rp {{ number_format($product['price'], 0, ',', '.') }}</p>

                                    @auth
                                        @if (auth()->user()->hasRole('pembeli'))
                                            <a href="{{ route('checkout') }}" class="btn btn-primary">Checkout</a>
                                        @else
                                            <a href="{{ route('login') }}" class="btn btn-outline">Lihat Produk</a>
                                        @endif
                                    @else
                                        <a href="{{ route('login') }}" class="btn btn-outline">Login untuk Checkout</a>
                                    @endauth
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <h3>PinTa Marketplace</h3>
        <p>Pindah Tangan Mahasiswa — ruang jual beli, barter, dan lelang kebutuhan mahasiswa.</p>
        <small>&copy; {{ date('Y') }} PinTa. All Rights Reserved.</small>
    </footer>
</body>
</html>
