<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Barter - PinTa</title>
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
    
        .offer-panel { max-width:760px; margin:28px auto; padding:24px; background:white; border:1px solid var(--line); border-radius:20px; box-shadow:var(--shadow); }
        .offer-panel h1 { font:800 25px 'Plus Jakarta Sans'; margin-bottom:8px; }
        .offer-panel h2 { font:700 17px 'Plus Jakarta Sans'; margin:22px 0 12px; }
        .offer-panel input:not([type=radio]):not([type=checkbox]), .offer-panel textarea, .offer-panel select { width:100%; padding:11px; border:1px solid var(--line); border-radius:10px; font:inherit; background:#faf9f8; }
        .offer-panel .choice { align-items:center; }
        .offer-panel .choice strong { display:block; }
        .offer-panel .field { font-size:14px; }
        .offer-panel .btn { display:inline-flex; justify-content:center; align-items:center; gap:8px; padding:12px 20px; border-radius:30px; }
        .offer-panel [hidden] { display:none !important; }
        .offer-panel .info-box { margin:16px 0; }
        .offer-panel .offer-actions { display:flex; gap:10px; flex-wrap:wrap; margin-top:20px; }
        .offer-panel .offer-actions .btn-barter { flex:1; }
        .offer-panel .item-photo { width:100px; height:100px; object-fit:contain; border-radius:10px; background:#f5f3f1; }
        .offer-panel .offer-item { border:1px solid var(--line); border-radius:12px; padding:14px; margin:12px 0; }
        .offer-panel .offer-item p { white-space:pre-wrap; overflow-wrap:anywhere; }
        @media(max-width:768px) { .offer-panel { margin:14px 12px; padding:16px; } }
    </style>
</head>
<body>
<header class="checkout-header">
    <a href="{{ route('dashboard') }}" class="brand-name">PINTA</a>
    <div class="steps"><span>1. Detail Produk</span><span>2. Checkout</span><span class="step-active">3. Pengajuan Barter</span></div>
    <a href="{{ route('barter.offers.index') }}" class="nav-link">Penawaran Saya</a>
</header>
<main class="offer-panel">
    <h1>Ajukan Penawaran Barter</h1>
    <p class="checkout-note">Tawarkan barang milikmu atau tambahan uang kepada pemilik barang.</p>
    @if ($errors->any())
        <div class="error-box" role="alert">@foreach ($errors->all() as $error)<p>{{ $error }}</p>@endforeach</div>
    @endif
    @php
        $mainImage = $product->primaryImage ?? $product->images->first();
        $source = old('source', $ownedListings->isNotEmpty() ? 'listing' : 'manual');
    @endphp
    <h2>Barang yang Ingin Ditukar</h2>
    <div class="checkout-product offer-item">
        @if ($mainImage)<img class="checkout-photo" src="{{ asset('storage/'.$mainImage->image_path) }}" alt="{{ $product->title }}">@else<div class="checkout-photo"><span class="material-symbols-outlined">inventory_2</span></div>@endif
        <div><span class="detail-badge mode-barter">Barter</span><h3>{{ $product->title }}</h3><p class="checkout-note">{{ $product->seller?->name }} · {{ $product->location }}</p><strong>{{ $product->price === null ? 'Nilai dapat dinegosiasikan' : 'Rp '.number_format($product->price,0,',','.') }}</strong></div>
    </div>
    <form method="POST" action="{{ route('barter.offers.store', $draft->id) }}" enctype="multipart/form-data">
        @csrf
        <h2>Pilih Barang Milikmu untuk Ditukar</h2>
        @foreach (['listing'=>'Barang dari etalase saya','manual'=>'Barang baru (belum dipublikasikan)','cash'=>'Tawaran uang saja'] as $value=>$label)
            <label class="choice"><input type="radio" name="source" value="{{ $value }}" @checked($source === $value) @disabled($value === 'listing' && $ownedListings->isEmpty())><span>{{ $label }}</span></label>
        @endforeach
        <div id="listing-fields" @if($source !== 'listing') hidden @endif>
            @forelse ($ownedListings as $listing)
                <label class="choice">
                    <input type="radio" name="offered_listing_id" value="{{ $listing->id }}" @checked((string)old('offered_listing_id', $ownedListings->first()?->id) === (string)$listing->id)>
                    @if($listing->primaryImage)<img class="item-photo" src="{{ asset('storage/'.$listing->primaryImage->image_path) }}" alt="{{ $listing->title }}">@endif
                    <span><strong>{{ $listing->title }}</strong><span class="checkout-note">{{ $listing->price === null ? 'Nilai belum ditetapkan' : 'Rp '.number_format($listing->price,0,',','.') }}</span></span>
                </label>
            @empty
                <p class="checkout-note">Belum ada barang aktif di etalase. Pilih barang baru.</p>
            @endforelse
        </div>
        <div id="manual-fields" @if($source !== 'manual') hidden @endif>
            <label class="field" for="item_name">Nama barang</label><input id="item_name" name="item_name" value="{{ old('item_name') }}" maxlength="150">
            <label class="field" for="description">Deskripsi barang</label><textarea id="description" name="description" rows="3" maxlength="2000">{{ old('description') }}</textarea>
            <label class="field" for="item_condition">Kondisi barang</label><select id="item_condition" name="item_condition">@foreach(['like_new'=>'Seperti baru','good'=>'Baik','fair'=>'Cukup','needs_repair'=>'Perlu perbaikan'] as $value=>$label)<option value="{{ $value }}" @selected(old('item_condition') === $value)>{{ $label }}</option>@endforeach</select>
            <label class="field" for="estimated_value">Estimasi nilai (Rp, opsional)</label><input id="estimated_value" name="estimated_value" type="number" min="0" max="9999999999" step="1" value="{{ old('estimated_value') }}">
            <label class="field" for="photo">Foto barang (maksimal 4 MB)</label><input id="photo" name="photo" type="file" accept="image/jpeg,image/png,image/webp"><p class="checkout-note">Foto harus dipilih ulang jika validasi gagal.</p>
        </div>
        <h2>Tambahan Uang</h2>
        <label class="field" for="cash_amount">Nominal (Rp)</label><input id="cash_amount" name="cash_amount" type="number" min="0" max="9999999999" step="1" required value="{{ old('cash_amount',0) }}">
        <p class="checkout-note">Isi 0 untuk barter murni. Nominal ini merupakan tawaran, bukan tagihan.</p>
        <label class="field" for="message">Catatan untuk pemilik</label><textarea id="message" name="message" rows="3" maxlength="2000" placeholder="Jelaskan kondisi barang dan rencana serah terima...">{{ old('message') }}</textarea>
        <div class="info-box"><strong>Ringkasan Checkout</strong><p>{{ $draft->delivery_method === 'cod' ? 'COD' : 'Pengiriman manual' }} · {{ $draft->delivery_address }}</p><p>Draft berlaku hingga {{ $draft->expires_at->timezone('Asia/Jakarta')->format('H:i') }} WIB.</p></div>
        <label class="choice"><input name="agreement" type="checkbox" value="1" required @checked(old('agreement'))><span>Saya menyatakan barang yang ditawarkan milik saya dan informasi yang diberikan benar.</span></label>
        <div class="offer-actions"><a class="btn btn-outline" href="{{ route('barter.checkout.ready',$draft->id) }}">Kembali</a><button class="btn btn-barter" type="submit"><span class="material-symbols-outlined">send</span> Kirim Penawaran</button></div>
    </form>
</main>
<script>
    function updateSource() {
        const source = document.querySelector('input[name="source"]:checked')?.value;
        ['listing','manual'].forEach(type => {
            const section = document.getElementById(type+'-fields');
            section.hidden = source !== type;
            section.querySelectorAll('input, select, textarea').forEach(field => field.disabled = section.hidden);
        });
        document.getElementById('item_name').required = source === 'manual';
        document.getElementById('photo').required = source === 'manual';
        document.getElementById('cash_amount').min = source === 'cash' ? '1' : '0';
    }
    document.querySelectorAll('input[name="source"]').forEach(radio => radio.addEventListener('change', updateSource));
    updateSource();
</script>
</body>
</html>
