<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Seller Center') - PinTa</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,400,0,0" rel="stylesheet">
    <style>
        :root{
            --primary:#89563f;--primary-dark:#70432f;--primary-soft:#f7eee8;
            --ink:#282522;--muted:#817a74;--line:#ebe5df;--surface:#fff;--canvas:#f8f6f3;
            --green:#247a50;--green-bg:#e9f5ed;--red:#b33c35;--red-bg:#fff0ee;
            --shadow:0 8px 28px rgba(54,39,28,.055)
        }
        *{box-sizing:border-box;margin:0;padding:0}
        body{font-family:Inter,Arial,sans-serif;background:var(--canvas);color:var(--ink);font-size:14px;line-height:1.55}
        a{color:inherit}
        .seller-navbar{height:72px;position:sticky;top:0;z-index:40;background:rgba(255,255,255,.9);backdrop-filter:blur(16px);border-bottom:1px solid var(--line)}
        .navbar-inner{height:100%;max-width:1440px;margin:auto;padding:0 32px;display:flex;justify-content:space-between;align-items:center;gap:20px}
        .seller-brand{display:flex;align-items:center;gap:12px;text-decoration:none}
        .brand-mark{width:40px;height:40px;background:var(--primary);color:#fff;border-radius:13px;display:grid;place-items:center}
        .brand-mark .material-symbols-outlined{font-size:22px}
        .brand-title{font-size:18px;font-weight:800;letter-spacing:-.6px;line-height:1.1}
        .brand-subtitle{display:block;color:var(--primary);font-size:10px;font-weight:700;margin-top:4px}
        .navbar-actions{display:flex;align-items:center;gap:17px}
        .seller-user{display:flex;align-items:center;gap:10px;padding-left:17px;border-left:1px solid var(--line)}
        .seller-avatar{width:36px;height:36px;border-radius:50%;background:var(--primary-soft);color:var(--primary);display:grid;place-items:center;font-weight:800}
        .user-name{font-size:12px;font-weight:800}.user-role{font-size:10px;color:var(--muted)}
        .market-link{display:inline-flex;align-items:center;gap:6px;padding:9px 14px;background:#fff;border:1px solid var(--line);border-radius:999px;text-decoration:none;font-size:11px;font-weight:750;transition:.2s}
        .market-link:hover{background:var(--primary-soft);border-color:#dfc9bb}
        .logout-button{border:0;background:none;color:var(--red);font:700 11px Inter,sans-serif;cursor:pointer}
        .seller-layout{max-width:1440px;margin:auto;padding:28px 32px;display:grid;grid-template-columns:245px minmax(0,1fr);gap:26px;align-items:start}
        .seller-sidebar{position:sticky;top:96px}
        .sidebar-heading{font-size:18px;font-weight:800;letter-spacing:-.5px;margin:3px 4px 16px}
        .sidebar-menu{background:#fff;border:1px solid var(--line);border-radius:19px;padding:9px;box-shadow:var(--shadow);display:grid;gap:4px}
        .sidebar-menu a{display:flex;align-items:center;gap:11px;padding:12px 13px;border-radius:12px;text-decoration:none;color:#625b55;font-size:12px;font-weight:650;transition:.2s}
        .sidebar-menu a .material-symbols-outlined{font-size:19px;color:#93877d}
        .sidebar-menu a:hover{background:#faf6f2;color:var(--primary)}
        .sidebar-menu a.active{background:var(--primary);color:#fff}
        .sidebar-menu a.active .material-symbols-outlined{color:#fff}
        .sidebar-note{margin-top:13px;background:#fff;border:1px solid var(--line);border-radius:16px;padding:14px;color:var(--muted);font-size:11px;line-height:1.7}
        .sidebar-note strong{display:block;color:var(--ink);font-size:12px;margin-bottom:3px}
        .seller-main{min-width:0}
        .page-title{margin:2px 2px 22px}
        .page-title h1{font-size:25px;line-height:1.25;letter-spacing:-.8px;font-weight:800}
        .page-title p{color:var(--muted);font-size:13px;margin-top:6px}
        .card{background:#fff;border:1px solid var(--line);border-radius:19px;padding:22px;box-shadow:var(--shadow);margin-bottom:17px}
        .card h2{font-size:17px;letter-spacing:-.4px;font-weight:800;margin-bottom:5px}
        .card>p{font-size:12px;color:var(--muted);line-height:1.75}
        .muted{color:var(--muted)}
        .stats{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:14px;margin:13px 0 19px}
        .stat-card{background:#fff;border:1px solid var(--line);border-radius:17px;padding:18px;box-shadow:var(--shadow);min-width:0}
        .stat-icon{width:39px;height:39px;border-radius:12px;background:var(--primary-soft);color:var(--primary);display:grid;place-items:center;margin-bottom:13px}
        .stat-card h3{font-size:11px;color:var(--muted);font-weight:700}
        .stat-card h2{font-size:20px;letter-spacing:-.6px;margin-top:4px}
        .stat-card p{font-size:10px;color:var(--muted);margin-top:5px;line-height:1.5}
        .btn{display:inline-flex;align-items:center;justify-content:center;gap:7px;padding:10px 16px;border:0;border-radius:999px;background:var(--primary);color:#fff;text-decoration:none;font:750 12px Inter,sans-serif;cursor:pointer;transition:.2s}
        .btn:hover{background:var(--primary-dark);transform:translateY(-1px)}
        .btn:disabled{opacity:.55;cursor:not-allowed;transform:none}
        .status{display:inline-flex;align-items:center;gap:6px;padding:5px 10px;border-radius:999px;font-size:10px;font-weight:800}
        .status::before{content:"";width:6px;height:6px;border-radius:50%;background:currentColor}
        .status-active{color:var(--green);background:var(--green-bg)}
        .status-inactive{color:var(--red);background:var(--red-bg)}
        .store-details{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:12px;margin-top:17px}
        .detail-item{padding:13px 14px;background:#faf8f5;border:1px solid #f0ebe6;border-radius:13px;min-width:0}
        .detail-label{font-size:10px;text-transform:uppercase;letter-spacing:.65px;color:var(--muted);font-weight:800;margin-bottom:5px}
        .detail-value{font-size:12px;font-weight:650;overflow-wrap:anywhere}
        .card-heading{display:flex;align-items:flex-start;justify-content:space-between;gap:12px;margin-bottom:13px}
        .empty-state{padding:27px 18px;background:#faf8f5;border:1px dashed #dfd5cc;border-radius:14px;text-align:center;color:var(--muted);font-size:12px;line-height:1.7}
        .empty-state .material-symbols-outlined{font-size:32px;color:#b9a99c;margin-bottom:7px}
        @media(max-width:900px){.seller-layout{grid-template-columns:210px minmax(0,1fr);padding:22px 20px;gap:18px}.navbar-inner{padding:0 20px}}
        @media(max-width:680px){
            .seller-navbar{height:64px}.navbar-inner{padding:0 14px}.brand-mark{width:36px;height:36px}
            .brand-title{font-size:16px}.brand-subtitle{font-size:9px}.navbar-actions{gap:9px}
            .market-link{font-size:0;padding:9px 10px}.market-link .material-symbols-outlined{font-size:18px}
            .seller-user{padding-left:9px;gap:7px}.seller-avatar{width:32px;height:32px}.user-name{font-size:10px}.user-role{font-size:9px}
            .logout-button{font-size:0}.logout-button .material-symbols-outlined{font-size:18px;vertical-align:middle}
            .seller-layout{display:block;padding:17px 14px 35px}.seller-sidebar{position:static;margin-bottom:18px}
            .sidebar-heading{font-size:15px;margin:0 2px 9px}
            .sidebar-menu{display:flex;overflow-x:auto;gap:5px;padding:7px;border-radius:14px}
            .sidebar-menu a{white-space:nowrap;padding:10px 12px;font-size:11px}
            .sidebar-menu a .material-symbols-outlined{font-size:17px}
            .sidebar-note{display:none}
            .page-title h1{font-size:21px}.page-title p{font-size:12px}
            .card{padding:16px;border-radius:16px}
            .stats{grid-template-columns:1fr;gap:10px}
            .stat-card{display:grid;grid-template-columns:40px 1fr;column-gap:12px;align-items:center;padding:14px}
            .stat-icon{grid-row:1/4;margin:0}.stat-card h3,.stat-card h2,.stat-card p{grid-column:2}
            .store-details{grid-template-columns:1fr}
        }
    </style>
    @yield('styles')
</head>
<body>
<header class="seller-navbar">
    <div class="navbar-inner">
        <a class="seller-brand" href="{{ route('seller.dashboard') }}">
            <span class="brand-mark"><span class="material-symbols-outlined">storefront</span></span>
            <span><span class="brand-title">PinTa Seller Center</span><span class="brand-subtitle">Ruang pengelolaan tokomu</span></span>
        </a>
        <div class="navbar-actions">
            <a class="market-link" href="/"><span class="material-symbols-outlined" style="font-size:15px">store</span>Lihat Marketplace</a>
            <div class="seller-user">
                <span class="seller-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                <span><span class="user-name">{{ auth()->user()->name }}</span><span class="user-role" style="display:block">Penjual</span></span>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="logout-button" type="submit"><span class="material-symbols-outlined" style="font-size:17px;vertical-align:middle">logout</span><span class="logout-text"> Logout</span></button>
            </form>
        </div>
    </div>
</header>

<div class="seller-layout">
    <aside class="seller-sidebar">
        <h2 class="sidebar-heading">Menu Penjual</h2>
        <nav class="sidebar-menu" aria-label="Navigasi Penjual">
            <a href="{{ route('seller.dashboard') }}" class="{{ request()->routeIs('seller.dashboard') ? 'active' : '' }}">
                <span class="material-symbols-outlined">dashboard</span>Dashboard
            </a>
            <a href="{{ route('seller.products.index') }}" class="{{ request()->routeIs('seller.products.*') ? 'active' : '' }}">
                <span class="material-symbols-outlined">inventory_2</span>Kelola Produk
            </a>
            <a href="/">
                <span class="material-symbols-outlined">storefront</span>Lihat Marketplace
            </a>
        </nav>
        <div class="sidebar-note"><strong>Seller Center PinTa</strong>Kelola informasi toko dan persiapkan produk untuk ditampilkan kepada pembeli.</div>
    </aside>
    <main class="seller-main">
        @yield('content')
    </main>
</div>
@yield('scripts')
</body>
</html>
