<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->title }} - PinTa</title>
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
        .breadcrumb { display: flex; align-items: center; gap: 8px; color: var(--muted); font-size: 13px; margin-bottom: 22px; flex-wrap: wrap; }
        .breadcrumb a:hover { color: var(--primary); }
        .detail-grid { display: grid; grid-template-columns: minmax(0,7fr) minmax(0,5fr); gap: 24px; align-items: start; }
        .detail-column { display: grid; gap: 20px; min-width: 0; }
        .detail-aside { position: sticky; top: 96px; }
        .detail-card { padding: 22px; border: 1px solid var(--line); border-radius: 20px; background: white; box-shadow: 0 4px 20px #30251c0a; }
        .gallery-main { position: relative; background: #f2f0ee; border-radius: 14px; overflow: hidden; }
        .gallery-main img { display: block; width: 100%; aspect-ratio: 4/3; object-fit: contain; }
        .gallery-empty { min-height: 260px; display: grid; place-items: center; color: var(--muted); }
        .gallery-badge { position: absolute; top: 12px; left: 12px; }
        .thumbnail-grid { display: grid; grid-template-columns: repeat(4,minmax(0,1fr)); gap: 10px; margin-top: 12px; }
        .thumbnail { border: 2px solid transparent; border-radius: 10px; background: #f2f0ee; overflow: hidden; cursor: pointer; }
        .thumbnail img { display: block; width: 100%; aspect-ratio: 1; object-fit: cover; }
        .thumbnail[aria-pressed="true"] { border-color: var(--primary); }
        .detail-card h2 { font: 800 19px 'Plus Jakarta Sans'; margin-bottom: 16px; }
        .detail-card h3 { font: 700 14px 'Plus Jakarta Sans'; }
        .spec-table { background: #faf9f8; border: 1px solid var(--line); border-radius: 12px; padding: 0 14px; }
        .spec-row { display: flex; justify-content: space-between; gap: 14px; padding: 12px 0; font-size: 13px; border-bottom: 1px solid var(--line); }
        .spec-row:last-child { border: 0; }
        .spec-row span { color: var(--muted); }
        .spec-row strong { text-align: right; overflow-wrap: anywhere; }
        .description { margin-top: 18px; }
        .description p { margin-top: 8px; white-space: pre-line; overflow-wrap: anywhere; color: #625b55; font-size: 14px; line-height: 1.8; }
        .seller-info { display: flex; align-items: center; gap: 14px; }
        .seller-avatar { width: 54px; height: 54px; flex-shrink: 0; border-radius: 50%; display: grid; place-items: center; background: #f2e9fa; color: #7542a8; }
        .seller-info p, .detail-note { color: var(--muted); font-size: 12px; line-height: 1.6; margin-top: 5px; }
        .badge-row { display: flex; align-items: center; gap: 8px; flex-wrap: wrap; }
        .detail-badge { display: inline-flex; padding: 6px 12px; border-radius: 30px; font-size: 11px; font-weight: 700; background: #f2f0ee; color: #625b55; }
        .mode-barter { background: #f5eaff; color: #7542a8; }
        .mode-direct { background: var(--primary-soft); color: var(--primary); }
        .mode-auction { background: #fff2d6; color: #a66a12; }
        .status-text { margin-left: auto; color: var(--green); font-size: 12px; }
        .detail-title { margin: 17px 0 8px; font: 800 26px/1.3 'Plus Jakarta Sans'; overflow-wrap: anywhere; }
        .detail-location { display: flex; align-items: center; gap: 6px; font-size: 13px; color: var(--muted); }
        .detail-price { margin: 18px 0; padding: 14px 0; border-block: 1px solid var(--line); }
        .detail-price small { color: var(--muted); font-size: 12px; }
        .detail-price strong { display: block; margin-top: 5px; font: 800 28px 'Plus Jakarta Sans'; }
        .info-box { border: 1px solid #7542a825; border-radius: 14px; background: #f5eaff; color: #7542a8; padding: 15px; }
        .info-box p { font-size: 13px; line-height: 1.7; margin-top: 7px; }
        .detail-actions { display: grid; gap: 10px; margin-top: 20px; }
        .detail-actions .btn { width: 100%; padding: 13px 16px; }
        .btn-barter { background: #7542a8; color: white; }
        .btn:disabled { opacity: .65; cursor: not-allowed; }
        .safety-card p { font-size: 13px; line-height: 1.7; color: var(--muted); }
        .detail-footer { margin-top: 24px; padding: 26px 20px; background: white; border-top: 1px solid var(--line); color: var(--muted); text-align: center; font-size: 12px; }
        @media(max-width: 1023px) {
            .topbar { height: auto; position: static; }
            .nav-inner { flex-wrap: wrap; padding: 14px 20px; gap: 12px; }
            .location-pill { display: none; }
            .search-wrap { order: 3; flex: 1 0 100%; max-width: none; }
            .nav-actions { flex-wrap: wrap; }
            .detail-grid { grid-template-columns: 1fr; }
            .detail-aside { position: static; display: grid !important; }
            .detail-column { display: contents; }
            .gallery-card { order: 0; }
            .detail-aside { order: 1; }
            .spec-card { order: 2; }
            .seller-card { order: 3; }
        }
        @media(max-width: 480px) {
            .page { padding: 18px 14px 32px; }
            .detail-card { padding: 15px; }
            .detail-title { font-size: 22px; }
            .nav-actions { gap: 4px; }
            .detail-price strong { font-size: 24px; }
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

            <form action="{{ route('dashboard') }}" method="GET" class="search-wrap">
                <span class="material-symbols-outlined">search</span>
                <input
                    type="search"
                    name="q"
                    value="{{ request('q') }}"
                    placeholder="Cari buku kuliah, laptop, perlengkapan kos..."
                >
            </form>

            <nav class="nav-actions">
                <a href="{{ route('dashboard') }}" class="nav-link">Beranda</a>
                <a href="{{ route('dashboard') }}#produk" class="nav-link">Katalog</a>

                @auth
                    @if (auth()->user()->hasRole('pembeli'))
                        
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


    @php
        $modeLabels = ['direct' => 'Jual Beli', 'barter' => 'Barter', 'auction' => 'Lelang'];
        $conditionLabels = ['like_new' => 'Seperti Baru', 'good' => 'Baik', 'fair' => 'Layak Pakai', 'needs_repair' => 'Perlu Perbaikan'];
        $mode = $modeLabels[$product->sale_mode] ?? 'Produk';
        $condition = $conditionLabels[$product->item_condition] ?? $product->item_condition;
        $mainImage = $product->primaryImage ?? $product->images->first();
        $isBarter = $product->sale_mode === 'barter';
    @endphp

    <main class="page">
        {{-- BREADCRUMB --}}
        <nav class="breadcrumb" aria-label="Breadcrumb">
            <a href="{{ route('dashboard') }}">Beranda</a>
            <span class="material-symbols-outlined">chevron_right</span>
            <a href="{{ route('dashboard') }}#produk">Katalog</a>
            <span class="material-symbols-outlined">chevron_right</span>
            <span>{{ $product->title }}</span>
        </nav>

        <div class="detail-grid">
            <div class="detail-column">
                {{-- GALERI FOTO PRODUK --}}
                <section class="detail-card gallery-card">
                    <div class="gallery-main">
                        @if ($mainImage)
                            <img id="main-product-image" src="{{ asset('storage/' . $mainImage->image_path) }}" alt="{{ $product->title }}">
                        @else
                            <div class="gallery-empty">Foto produk belum tersedia</div>
                        @endif
                        <span class="detail-badge gallery-badge mode-{{ $product->sale_mode }}">{{ $isBarter ? 'Mode Barter (Tukar Barang)' : $mode }}</span>
                    </div>
                    @if ($product->images->isNotEmpty())
                        <div class="thumbnail-grid">
                            @foreach ($product->images as $image)
                                <button type="button" class="thumbnail" data-image="{{ asset('storage/' . $image->image_path) }}" aria-label="Lihat foto {{ $loop->iteration }}" aria-pressed="{{ $mainImage?->id === $image->id ? 'true' : 'false' }}">
                                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="Foto {{ $loop->iteration }} {{ $product->title }}">
                                </button>
                            @endforeach
                        </div>
                    @endif
                </section>

                {{-- DESKRIPSI DAN SPESIFIKASI --}}
                <section class="detail-card spec-card">
                    <h2>{{ $isBarter ? 'Detail Barang yang Ditawarkan' : 'Deskripsi & Spesifikasi' }}</h2>
                    <div class="spec-table">
                        <div class="spec-row"><span>Kondisi Barang</span><strong>{{ $condition }}</strong></div>
                        <div class="spec-row"><span>Kategori</span><strong>{{ $product->category?->name ?? 'Belum tersedia' }}</strong></div>
                        <div class="spec-row"><span>Lokasi</span><strong>{{ $product->location }}</strong></div>
                        <div class="spec-row"><span>Mode Transaksi</span><strong>{{ $mode }}</strong></div>
                    </div>
                    <div class="description">
                        <h3>{{ $isBarter ? 'Catatan Pemilik:' : 'Catatan Penjual:' }}</h3>
                        <p>{{ $product->description }}</p>
                    </div>
                </section>

                {{-- INFORMASI PEMILIK --}}
                <section class="detail-card seller-card">
                    <h2>{{ $isBarter ? 'Informasi Pemilik Barang' : 'Informasi Penjual' }}</h2>
                    <div class="seller-info">
                        <div class="seller-avatar"><span class="material-symbols-outlined">person</span></div>
                        <div>
                            <h3>{{ $product->seller?->name ?? 'Penjual tidak tersedia' }}</h3>
                            <p>{{ $product->location }}</p>
                        </div>
                    </div>
                </section>
            </div>

            {{-- INFORMASI DAN AKSI TRANSAKSI --}}
            <aside class="detail-column detail-aside">
                <section class="detail-card">
                    <div class="badge-row">
                        <span class="detail-badge mode-{{ $product->sale_mode }}">{{ $mode }}</span>
                        <span class="detail-badge">{{ $condition }}</span>
                        <span class="status-text">{{ $isBarter ? 'Aktif barter' : 'Tersedia' }}</span>
                    </div>
                    <h1 class="detail-title">{{ $product->title }}</h1>
                    <p class="detail-location"><span class="material-symbols-outlined">location_on</span>{{ $product->location }}</p>
                    <div class="detail-price">
                        <small>{{ $isBarter ? 'Estimasi Nilai Barang' : ($product->sale_mode === 'auction' ? 'Harga Acuan' : 'Harga Barang') }}</small>
                        <strong>
                            @if ($product->price !== null)
                                {{ $isBarter ? '~' : '' }}Rp {{ number_format($product->price, 0, ',', '.') }}
                            @else
                                {{ $isBarter ? 'Dapat dinegosiasikan' : 'Belum tersedia' }}
                            @endif
                        </strong>
                    </div>
                    @if ($isBarter)
                        <div class="info-box">
                            <h3><span class="material-symbols-outlined">find_replace</span> Kriteria Barang Tukar</h3>
                            <p>Periksa catatan pemilik untuk mengetahui ketentuan barter. Penawaran barang dan uang tambahan akan dipertimbangkan oleh pemilik.</p>
                        </div>
                    @endif
                    <div class="detail-actions">
                        @auth
                            @if (auth()->id() == $product->seller_id)
                                <button type="button" class="btn btn-primary" disabled>Ini Produk Milik Anda</button>
                            @elseif (!auth()->user()->hasRole('pembeli'))
                                <button type="button" class="btn btn-primary" disabled>Akses Pembeli Diperlukan</button>
                            {{-- button untuk barter --}}
                            @elseif ($isBarter)
                                <a href="{{ route('barter.checkout.create', $product->id) }}"class="btn btn-barter">
                                    <span class="material-symbols-outlined">swap_horiz</span>
                                    Lanjut Checkout Barter
                                </a>
                            @else
                                <button type="button" class="btn btn-primary" disabled>{{ $product->sale_mode === 'auction' ? 'Ikuti Lelang' : 'Beli Sekarang' }}</button>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="btn {{ $isBarter ? 'btn-barter' : 'btn-primary' }}">Login untuk Melanjutkan</a>
                        @endauth
                    </div>
                </section>
                <section class="detail-card safety-card">
                    <h2><span class="material-symbols-outlined">verified_user</span> Panduan Aman PinTa</h2>
                    <p>Periksa kondisi barang dan sepakati lokasi serah terima di tempat umum sebelum menyelesaikan transaksi.</p>
                </section>
            </aside>
        </div>
    </main>

    <footer class="detail-footer">&copy; {{ date('Y') }} PinTa — Pindah Tangan Mahasiswa Jambi</footer>

    <script>
        const mainImage = document.getElementById('main-product-image');
        const thumbnails = document.querySelectorAll('.thumbnail');

        thumbnails.forEach(function (thumbnail) {
            thumbnail.addEventListener('click', function () {
                if (!mainImage) return;
                mainImage.src = thumbnail.dataset.image;
                thumbnails.forEach(function (item) {
                    item.setAttribute('aria-pressed', 'false');
                });
                thumbnail.setAttribute('aria-pressed', 'true');
            });
        });
    </script>
</body>
</html>
