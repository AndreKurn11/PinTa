<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin PinTa') - PinTa</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,400,0,0" rel="stylesheet">
    <style>
        :root {
            --primary:#89563f; --primary-dark:#70432f; --primary-soft:#f7eee8;
            --ink:#282522; --muted:#817a74; --line:#ebe5df; --surface:#fff;
            --canvas:#f8f6f3; --green:#247a50; --green-bg:#e9f5ed;
            --amber:#9a6418; --amber-bg:#fff4df; --red:#b33c35; --red-bg:#fff0ee;
            --shadow:0 8px 28px rgba(54,39,28,.055);
        }
        *{box-sizing:border-box;margin:0;padding:0}
        body{font-family:Inter,Arial,sans-serif;background:var(--canvas);color:var(--ink);font-size:14px;line-height:1.55}
        a{color:inherit}
        .admin-topbar{height:72px;position:sticky;top:0;z-index:50;background:rgba(255,255,255,.88);backdrop-filter:blur(16px);border-bottom:1px solid var(--line)}
        .topbar-inner{max-width:1440px;height:100%;margin:auto;padding:0 32px;display:flex;align-items:center;justify-content:space-between;gap:20px}
        .brand{display:flex;align-items:center;gap:12px;text-decoration:none}
        .brand-mark{width:40px;height:40px;border-radius:13px;background:var(--primary);color:white;display:grid;place-items:center}
        .brand-mark .material-symbols-outlined{font-size:22px}
        .brand-name{font-size:18px;font-weight:800;letter-spacing:-.6px;line-height:1.1}
        .brand-caption{font-size:10px;color:var(--primary);font-weight:700;margin-top:4px}
        .topbar-right{display:flex;align-items:center;gap:18px}
        .market-link{padding:9px 15px;border:1px solid var(--line);background:white;border-radius:999px;text-decoration:none;font-size:12px;font-weight:700;transition:.2s}
        .market-link:hover{background:var(--primary-soft);border-color:#dfc9bb}
        .admin-profile{display:flex;align-items:center;gap:10px;padding-left:18px;border-left:1px solid var(--line)}
        .avatar{width:36px;height:36px;border-radius:50%;background:var(--primary-soft);color:var(--primary);display:grid;place-items:center;font-weight:800}
        .profile-name{font-size:12px;font-weight:800}.profile-role{font-size:10px;color:var(--muted)}
        .workspace{max-width:1440px;margin:auto;padding:28px 32px;display:grid;grid-template-columns:250px minmax(0,1fr);gap:26px;align-items:start}
        .sidebar{position:sticky;top:96px}
        .side-heading{font-size:19px;font-weight:800;letter-spacing:-.5px;margin:3px 4px 17px}
        .side-nav,.side-panel{background:var(--surface);border:1px solid var(--line);border-radius:19px;padding:10px;box-shadow:var(--shadow)}
        .side-nav{display:grid;gap:4px}
        .nav-link{display:flex;align-items:center;gap:11px;padding:12px 13px;border-radius:12px;text-decoration:none;color:#625b55;font-size:12px;font-weight:650;transition:.2s}
        .nav-link .material-symbols-outlined{font-size:19px;color:#93877d}
        .nav-link:hover{background:#faf6f2;color:var(--primary)}
        .nav-link.active{background:var(--primary);color:white}
        .nav-link.active .material-symbols-outlined{color:white}
        .side-bottom{margin-top:14px;padding:14px 13px;background:var(--surface);border:1px solid var(--line);border-radius:17px}
        .side-bottom a,.logout-button{display:flex;align-items:center;gap:9px;text-decoration:none;font-size:12px;font-weight:650;color:#655d56}
        .side-bottom a:hover{color:var(--primary)}
        .logout-form{margin-top:14px;padding-top:13px;border-top:1px solid var(--line)}
        .logout-button{border:0;background:none;color:var(--red);cursor:pointer;font:inherit}
        .main-area{min-width:0}
        .content{min-width:0}
        .page-title{margin:2px 2px 22px}
        .page-title h1{font-size:25px;line-height:1.25;letter-spacing:-.8px;font-weight:800}
        .page-title p{color:var(--muted);font-size:13px;margin-top:6px}
        .panel{background:var(--surface);border:1px solid var(--line);border-radius:19px;padding:22px;box-shadow:var(--shadow)}
        .panel-heading{display:flex;justify-content:space-between;align-items:flex-start;gap:14px;margin-bottom:18px}
        .panel-heading h2{font-size:17px;letter-spacing:-.4px;font-weight:800}
        .panel-heading p{font-size:12px;color:var(--muted);margin-top:4px}
        .alert{padding:12px 15px;border-radius:12px;margin-bottom:16px;font-size:13px;font-weight:600}
        .alert-success{background:var(--green-bg);color:var(--green);border:1px solid #cfe8d7}
        .alert-danger{background:var(--red-bg);color:var(--red);border:1px solid #f1d1cd}
        .btn{display:inline-flex;align-items:center;justify-content:center;gap:7px;border:0;border-radius:999px;padding:10px 16px;background:var(--primary);color:white;text-decoration:none;font:700 12px Inter,sans-serif;cursor:pointer;transition:.2s}
        .btn:hover{background:var(--primary-dark);transform:translateY(-1px)}
        .btn-secondary{background:white;color:var(--ink);border:1px solid var(--line)}
        .btn-secondary:hover{background:var(--canvas)}
        .btn-danger{background:var(--red)}.btn-danger:hover{background:#982f29}
        .field-label{display:block;font-size:12px;font-weight:750;margin-bottom:7px}
        .field-input{width:100%;border:1px solid #e5ded7;background:#fff;border-radius:12px;padding:12px 13px;font:13px Inter,sans-serif;color:var(--ink);outline:none;transition:.2s}
        .field-input:focus{border-color:var(--primary);box-shadow:0 0 0 3px rgba(137,86,63,.11)}
        .field-error{color:var(--red);font-size:11px;margin-top:5px}
        .status{display:inline-flex;align-items:center;gap:6px;padding:5px 10px;border-radius:999px;font-size:10px;font-weight:800;white-space:nowrap}
        .status::before{content:"";width:6px;height:6px;border-radius:50%;background:currentColor}
        .status-pending{color:var(--amber);background:var(--amber-bg)}
        .status-approved{color:var(--green);background:var(--green-bg)}
        .status-rejected{color:var(--red);background:var(--red-bg)}
        .table-wrap{width:100%;overflow-x:auto}
        .admin-table{width:100%;border-collapse:collapse;min-width:760px}
        .admin-table th{text-align:left;background:#faf8f5;color:#817970;font-size:10px;text-transform:uppercase;letter-spacing:.7px;padding:13px 14px;font-weight:800}
        .admin-table th:first-child{border-radius:10px 0 0 10px}.admin-table th:last-child{border-radius:0 10px 10px 0}
        .admin-table td{padding:15px 14px;border-bottom:1px solid #f0ebe6;font-size:12px;vertical-align:middle}
        .admin-table tbody tr:last-child td{border-bottom:0}
        .admin-table tbody tr:hover{background:#fdfbf9}
        .person-name{font-weight:750;color:var(--ink)}.subtext{font-size:11px;color:var(--muted);margin-top:3px}
        .text-link{color:var(--primary);font-weight:800;text-decoration:none;font-size:12px}
        .text-link:hover{text-decoration:underline}
        .empty-state{text-align:center;padding:42px 20px;color:var(--muted)}
        .empty-state .material-symbols-outlined{font-size:34px;color:#b9a99c;margin-bottom:8px}
        .pagination{margin-top:18px}
        .pagination nav{display:flex;justify-content:space-between;align-items:center;gap:10px}
        .pagination nav>div:first-child{font-size:11px;color:var(--muted)}
        .pagination nav>div:last-child span,.pagination nav>div:last-child a{display:inline-flex;align-items:center;justify-content:center;min-width:34px;height:34px;padding:0 10px;border:1px solid var(--line);border-radius:9px;text-decoration:none;font-size:11px;margin-left:3px}
        .pagination nav>div:last-child span[aria-current="page"]{background:var(--primary);color:#fff;border-color:var(--primary)}
        .detail-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:13px}
        .detail-item{padding:14px 15px;background:#faf8f5;border:1px solid #f0ebe6;border-radius:13px;min-width:0}
        .detail-item.full{grid-column:1/-1}
        .detail-label{font-size:10px;text-transform:uppercase;letter-spacing:.65px;color:var(--muted);font-weight:800;margin-bottom:5px}
        .detail-value{font-size:13px;font-weight:650;overflow-wrap:anywhere}
        .action-grid{display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-top:20px}
        .action-card{border:1px solid var(--line);border-radius:15px;padding:17px}
        .action-card h3{font-size:14px;font-weight:800;margin-bottom:5px}
        .action-card p{font-size:11px;color:var(--muted);margin-bottom:13px}
        .mobile-nav{display:none}
        @media(max-width:900px){.workspace{grid-template-columns:210px minmax(0,1fr);padding:22px 20px;gap:18px}.topbar-inner{padding:0 20px}}
        @media(max-width:680px){
            .admin-topbar{height:64px}.topbar-inner{padding:0 15px}.brand-mark{width:36px;height:36px}
            .brand-name{font-size:16px}.brand-caption{font-size:9px}.market-link{font-size:0;padding:9px 11px}.market-link .material-symbols-outlined{font-size:18px}
            .admin-profile{padding-left:11px;gap:7px}.profile-name{font-size:11px}.profile-role{font-size:9px}
            .workspace{display:block;padding:17px 14px 88px}.sidebar{position:static;margin-bottom:18px}
            .side-heading{font-size:15px;margin:0 2px 9px}.side-nav{display:flex;overflow-x:auto;gap:5px;padding:7px;border-radius:14px}
            .nav-link{white-space:nowrap;padding:10px 12px;font-size:11px}.nav-link .material-symbols-outlined{font-size:17px}
            .side-bottom{display:flex;justify-content:space-between;align-items:center;margin-top:8px;padding:10px 12px}
            .logout-form{margin:0;padding:0;border:0}.side-bottom a,.logout-button{font-size:10px}
            .page-title h1{font-size:21px}.page-title p{font-size:12px}
            .panel{padding:16px;border-radius:16px}.panel-heading{display:block}.panel-heading .status{margin-top:10px}
            .detail-grid,.action-grid{grid-template-columns:1fr}.detail-item.full{grid-column:auto}
            .pagination nav{align-items:flex-start;flex-direction:column}
        }
    </style>
    @yield('styles')
</head>
<body>
<header class="admin-topbar">
    <div class="topbar-inner">
        <a class="brand" href="{{ route('admin.dashboard') }}">
            <span class="brand-mark"><span class="material-symbols-outlined">admin_panel_settings</span></span>
            <span><span class="brand-name">PINTA Admin</span><span class="brand-caption" style="display:block">Pusat Pengelolaan Marketplace</span></span>
        </a>
        <div class="topbar-right">
            <a class="market-link" href="{{ route('dashboard') }}"><span class="material-symbols-outlined" style="font-size:15px;vertical-align:middle;margin-right:4px">storefront</span>Lihat Marketplace</a>
            <div class="admin-profile">
                <span class="avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                <span><span class="profile-name">{{ auth()->user()->name }}</span><span class="profile-role" style="display:block">Administrator</span></span>
            </div>
        </div>
    </div>
</header>

<div class="workspace">
    <aside class="sidebar">
        <h2 class="side-heading">Navigasi Admin</h2>
        <nav class="side-nav" aria-label="Navigasi Admin">
            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                <span class="material-symbols-outlined">dashboard</span>Dashboard
            </a>
            <a class="nav-link {{ request()->routeIs('admin.seller-registrations.*') ? 'active' : '' }}" href="{{ route('admin.seller-registrations.index') }}">
                <span class="material-symbols-outlined">how_to_reg</span>Pendaftaran Penjual
            </a>
            <a class="nav-link" href="{{ route('admin.seller-registrations.index') }}">
                <span class="material-symbols-outlined">store</span>Kelola Toko
            </a>
        </nav>
        <div class="side-bottom">
            <a href="{{ route('dashboard') }}"><span class="material-symbols-outlined" style="font-size:17px">arrow_back</span>Kembali ke Marketplace</a>
            <form class="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="logout-button" type="submit"><span class="material-symbols-outlined" style="font-size:17px">logout</span>Keluar dari Admin</button>
            </form>
        </div>
    </aside>
    <main class="main-area">
        <section class="content">
            @yield('content')
        </section>
    </main>
</div>
@yield('scripts')
</body>
</html>
