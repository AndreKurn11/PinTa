<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serah Terima Barter - PinTa</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <style>
        *{box-sizing:border-box}body{margin:0;background:#f7f6f4;color:#292521;font-family:'DM Sans',sans-serif}a{color:inherit;text-decoration:none}.topbar{display:flex;justify-content:space-between;align-items:center;gap:12px;padding:18px 5%;background:#fff;border-bottom:1px solid #ebe7e3}.brand{font:800 22px 'Plus Jakarta Sans',sans-serif;color:#9a5b3d}.topbar a:not(.brand){font-size:13px;color:#827b75}.page{max-width:1160px;margin:28px auto;padding:0 20px 40px}
    </style>
    @include('barter.handover-styles')
</head>
<body>
<header class="topbar"><a href="{{ route('dashboard') }}" class="brand">PINTA</a><a href="{{ route('barter.offers.index') }}">Penawaran Saya</a></header>
<main class="page">
    @include('barter.handover-content')
</main>
</body>
</html>
