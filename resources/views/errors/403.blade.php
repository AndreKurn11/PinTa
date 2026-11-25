<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Akses Ditolak | PinTa</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,400,0,0" rel="stylesheet">
    <style>
        :root {
            --primary: #89563f;
            --primary-dark: #70432f;
            --primary-soft: #f7eee8;
            --ink: #282522;
            --muted: #817a74;
            --line: #ebe5df;
            --canvas: #f8f6f3;
            --red: #b33c35;
            --red-soft: #fff0ee;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 28px 16px;
            background:
                radial-gradient(circle at 12% 10%, #f2e5da 0, transparent 28%),
                radial-gradient(circle at 90% 90%, #efe7df 0, transparent 25%),
                var(--canvas);
            color: var(--ink);
            font-family: Inter, Arial, sans-serif;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 22px;
            text-decoration: none;
            color: var(--ink);
        }

        .brand-mark {
            width: 40px;
            height: 40px;
            display: grid;
            place-items: center;
            border-radius: 13px;
            background: var(--primary);
            color: white;
        }

        .brand-mark .material-symbols-outlined { font-size: 22px; }
        .brand-name { font-size: 18px; font-weight: 800; letter-spacing: -.6px; }
        .brand-caption { display: block; margin-top: 2px; color: var(--primary); font-size: 10px; font-weight: 700; }

        .error-card {
            width: 100%;
            max-width: 490px;
            padding: 38px 34px;
            border: 1px solid var(--line);
            border-radius: 23px;
            background: rgba(255,255,255,.94);
            box-shadow: 0 14px 42px rgba(54,39,28,.08);
            text-align: center;
        }

        .error-icon {
            width: 76px;
            height: 76px;
            display: grid;
            place-items: center;
            margin: 0 auto 17px;
            border-radius: 23px;
            background: var(--red-soft);
            color: var(--red);
        }

        .error-icon .material-symbols-outlined { font-size: 38px; }

        .error-code {
            color: var(--primary);
            font-size: clamp(54px, 13vw, 76px);
            line-height: 1;
            font-weight: 800;
            letter-spacing: -4px;
        }

        h1 {
            margin-top: 12px;
            font-size: 21px;
            line-height: 1.3;
            font-weight: 800;
            letter-spacing: -.5px;
        }

        .message {
            max-width: 360px;
            margin: 10px auto 23px;
            color: var(--muted);
            font-size: 13px;
            line-height: 1.8;
        }

        .notice {
            display: flex;
            align-items: flex-start;
            gap: 9px;
            margin-bottom: 22px;
            padding: 12px 13px;
            border: 1px solid #f0e2d8;
            border-radius: 13px;
            background: #fbf7f3;
            color: #75675d;
            text-align: left;
            font-size: 11px;
            line-height: 1.65;
        }

        .notice .material-symbols-outlined {
            flex: 0 0 auto;
            color: var(--primary);
            font-size: 18px;
        }

        .actions { display: flex; justify-content: center; gap: 10px; flex-wrap: wrap; }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 43px;
            padding: 11px 18px;
            border: 1px solid var(--primary);
            border-radius: 999px;
            background: var(--primary);
            color: white;
            text-decoration: none;
            font-size: 12px;
            font-weight: 750;
            transition: .2s;
        }

        .btn:hover { background: var(--primary-dark); border-color: var(--primary-dark); transform: translateY(-1px); }
        .btn .material-symbols-outlined { font-size: 17px; }

        .footer {
            margin-top: 20px;
            color: #9a9189;
            font-size: 10px;
            text-align: center;
        }

        @media (max-width: 520px) {
            .error-card { padding: 30px 20px; border-radius: 19px; }
            h1 { font-size: 19px; }
            .message { font-size: 12px; }
            .actions { display: grid; }
            .btn { width: 100%; }
        }
    </style>
</head>
<body>
    <a href="{{ route('dashboard') }}" class="brand" aria-label="PinTa">
        <span class="brand-mark"><span class="material-symbols-outlined">storefront</span></span>
        <span>
            <span class="brand-name">PinTa</span>
            <span class="brand-caption">Marketplace</span>
        </span>
    </a>

    <main class="error-card">
        <div class="error-icon">
            <span class="material-symbols-outlined">lock</span>
        </div>

        <div class="error-code">403</div>
        <h1>Akses Ditolak</h1>
        <p class="message">
            Maaf, akun kamu tidak memiliki izin untuk mengakses halaman ini.
            Silakan kembali ke dashboard atau hubungi administrator jika merasa ini adalah kesalahan.
        </p>

        <div class="notice">
            <span class="material-symbols-outlined">info</span>
            <span>Halaman ini dilindungi oleh sistem hak akses PinTa. Pastikan kamu masuk menggunakan akun dengan role yang sesuai.</span>
        </div>

        <div class="actions">
            <a href="{{ route('dashboard') }}" class="btn">
                <span class="material-symbols-outlined">arrow_back</span>
                Kembali ke Dashboard
            </a>
        </div>
    </main>

    <p class="footer">© {{ date('Y') }} PinTa Marketplace · Akses Aman untuk Semua</p>
</body>
</html>
