<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Barter - PinTa</title>
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
    
        .checkout-wrap { max-width: 1160px; margin: 28px auto; padding: 0 20px 40px; }
        .checkout-header { background: white; border-bottom: 1px solid var(--line); padding: 18px 5%; display:flex; justify-content:space-between; align-items:center; gap:12px; flex-wrap:wrap; }
        .steps { display:flex; gap: 14px; font-size:13px; align-items:center; flex-wrap:wrap; }
        .step-active { color:#7542a8; font-weight:700; }
        .checkout-grid { display:grid; grid-template-columns:minmax(0, 1.65fr) minmax(0, 1fr); gap:24px; align-items:start; }
        .checkout-card { background:white; border:1px solid #ebe7e3; border-radius:16px; padding:22px; margin-bottom:16px; }
        .checkout-card h2 { font-size:18px; margin:0 0 16px; }
        .checkout-product { display:flex; gap:16px; align-items:center; }
        .checkout-photo { width:96px; height:96px; object-fit:cover; border-radius:12px; background:#f5f3f1; display:grid; place-items:center; flex-shrink:0; }
        .field { display:block; font-weight:600; margin:16px 0 6px; }
        .checkout-card textarea { width:100%; border:1px solid #ded9d4; border-radius:10px; padding:12px; font:inherit; resize:vertical; }
        .choice { display:flex; align-items:flex-start; gap:12px; border:1px solid #ebe7e3; border-radius:12px; padding:14px; margin:10px 0; cursor:pointer; }
        .choice:has(input:checked) { background:#f5eaff; border-color:#7542a8; }
        .choice input { accent-color:#7542a8; }
        .summary-row { display:flex; justify-content:space-between; gap:12px; padding:12px 0; border-bottom:1px solid #ebe7e3; }
        .checkout-submit { width:100%; margin-top:18px; }
        .checkout-note { color:#827b75; font-size:13px; line-height:1.6; }
        .error-box { background:#fff0ef; color:#a32323; padding:14px; border-radius:10px; margin-bottom:16px; }
        @media(max-width:768px) { .checkout-grid { grid-template-columns:1fr; gap:0; } .checkout-wrap { padding:0 12px 24px; } }
    </style>
</head>
<body>
    <header class="checkout-header">
        <a href="{{ route('products.show', $product->id) }}" class="nav-link">← Kembali ke Detail</a>
        <div class="steps"><span>1. Detail Produk</span><span class="step-active">2. Checkout</span><span>3. Pengajuan Barter</span></div>
        <a href="{{ route('dashboard') }}" class="brand-name">PINTA</a>
    </header>
    <main class="checkout-wrap">
        <p class="breadcrumb">Beranda / Detail Produk / Checkout Barter</p>
        <h1>Pengiriman &amp; Checkout Barang</h1>
        <p class="checkout-note">Konfirmasi metode serah terima sebelum mengajukan penawaran barter.</p>
        @if ($errors->any())
            <div class="error-box" role="alert">@foreach ($errors->all() as $error)<div>{{ $error }}</div>@endforeach</div>
        @endif
        @php
            $photo = $product->primaryImage ?? $product->images->first();
            $method = old('delivery_method', $draft?->delivery_method ?? 'cod');
        @endphp
        <form method="POST" action="{{ route('barter.checkout.store', $product->id) }}" class="checkout-grid">
            @csrf
            <div>
                <section class="checkout-card">
                    <h2><span class="material-symbols-outlined">location_on</span> Alamat &amp; Titik Serah Terima</h2>
                    <strong>{{ auth()->user()->name }}</strong>
                    <label class="field" for="delivery_address">Alamat atau titik temu</label>
                    <textarea id="delivery_address" name="delivery_address" rows="3" maxlength="1000" required>{{ old('delivery_address', $draft?->delivery_address ?? auth()->user()->address) }}</textarea>
                    <p class="checkout-note">Untuk COD, isi lokasi pertemuan yang diusulkan. Untuk pengiriman, isi alamat tujuan.</p>
                </section>
                <section class="checkout-card">
                    <h2>Barang yang Dipilih</h2>
                    <div class="checkout-product">
                        @if ($photo)
                            <img class="checkout-photo" src="{{ asset('storage/' . $photo->image_path) }}" alt="{{ $product->title }}">
                        @else
                            <div class="checkout-photo"><span class="material-symbols-outlined">image</span></div>
                        @endif
                        <div><span class="badge mode-barter">Barter</span><h3>{{ $product->title }}</h3><p class="checkout-note">{{ $product->seller?->name }} · {{ $product->location }}</p></div>
                    </div>
                </section>
                <section class="checkout-card">
                    <h2>Metode Serah Terima</h2>
                    <label class="choice"><input type="radio" name="delivery_method" value="cod" @checked($method === 'cod') required><span><strong>COD / Bertemu langsung</strong><br><span class="checkout-note">Sepakati titik temu bersama pemilik barang.</span></span></label>
                    <label class="choice"><input type="radio" name="delivery_method" value="shipping" @checked($method === 'shipping') required><span><strong>Pengiriman manual</strong><br><span class="checkout-note">Kurir dan biaya disepakati kemudian.</span></span></label>
                    <label class="field" for="notes">Catatan (opsional)</label>
                    <textarea id="notes" name="notes" rows="3" maxlength="2000">{{ old('notes', $draft?->notes) }}</textarea>
                </section>
            </div>
            <aside>
                <section class="checkout-card">
                    <h2>Ringkasan Checkout</h2>
                    <div class="summary-row"><span>Estimasi nilai barang</span><strong>{{ $product->price === null ? 'Negosiasi' : 'Rp ' . number_format($product->price, 0, ',', '.') }}</strong></div>
                    <div class="summary-row"><span>Uang tambahan</span><strong>Belum ditentukan</strong></div>
                    <div class="summary-row"><span>Ongkir &amp; biaya layanan</span><strong>Belum dihitung</strong></div>
                    <div class="info-box"><strong>Belum ada pembayaran</strong><p>Nilai barang bukan tagihan. Penawaran dan biaya ditentukan setelah checkout.</p></div>
                    <button type="submit" class="btn btn-barter checkout-submit">Lanjut Pengajuan Barter</button>
                    <p class="checkout-note">Draft berlaku 30 menit setelah disimpan. Produk belum direservasi.</p>
                </section>
            </aside>
        </form>
    </main>
    <footer class="detail-footer">&copy; {{ date('Y') }} PinTa — Pindah Tangan Mahasiswa Jambi</footer>
</body>
</html>
