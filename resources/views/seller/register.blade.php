<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Menjadi Penjual - PinTa</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,400,0,0" rel="stylesheet">
    <style>
        :root{--primary:#89563f;--primary-dark:#70432f;--primary-soft:#f7eee8;--ink:#282522;--muted:#817a74;--line:#ebe5df;--canvas:#f8f6f3;--green:#247a50;--green-bg:#e9f5ed;--amber:#9a6418;--amber-bg:#fff4df;--red:#b33c35;--red-bg:#fff0ee}
        *{box-sizing:border-box;margin:0;padding:0}
        body{min-height:100vh;padding:36px 16px;background:radial-gradient(circle at 12% 10%,#f4e9df 0,transparent 28%),var(--canvas);font-family:Inter,Arial,sans-serif;color:var(--ink);font-size:14px;line-height:1.6}
        .register-wrap{max-width:690px;margin:auto}
        .top-link{display:inline-flex;align-items:center;gap:7px;color:var(--primary);text-decoration:none;font-size:12px;font-weight:750;margin:0 0 17px 4px}
        .top-link:hover{color:var(--primary-dark)}
        .register-card{background:#fff;border:1px solid var(--line);border-radius:23px;padding:32px;box-shadow:0 14px 42px rgba(54,39,28,.08)}
        .brand-mark{width:46px;height:46px;border-radius:15px;background:var(--primary);color:white;display:grid;place-items:center;margin-bottom:18px}
        .brand-mark .material-symbols-outlined{font-size:25px}
        h1{font-size:25px;line-height:1.25;letter-spacing:-.8px;font-weight:800}
        .intro{font-size:13px;color:var(--muted);margin-top:8px;margin-bottom:23px;max-width:550px}
        .alert{padding:13px 15px;border-radius:13px;margin-bottom:15px;font-size:12px;line-height:1.65;border:1px solid transparent}
        .alert-warning{background:var(--amber-bg);color:var(--amber);border-color:#f2dfb8}
        .alert-error{background:var(--red-bg);color:var(--red);border-color:#f1d1cd}
        .alert-success{background:var(--green-bg);color:var(--green);border-color:#cfe8d7}
        .form-grid{display:grid;grid-template-columns:1fr 1fr;gap:0 15px}
        .field{margin-bottom:16px;min-width:0}
        label{display:block;font-size:11px;font-weight:800;margin-bottom:7px}
        input,textarea{width:100%;border:1px solid #e5ded7;background:#fff;border-radius:12px;padding:12px 13px;font:13px Inter,sans-serif;color:var(--ink);outline:none;transition:.2s}
        input:focus,textarea:focus{border-color:var(--primary);box-shadow:0 0 0 3px rgba(137,86,63,.11)}
        textarea{min-height:105px;resize:vertical}
        .field-error{color:var(--red);font-size:11px;margin-top:5px}
        .submit-btn{width:100%;display:flex;align-items:center;justify-content:center;gap:8px;border:0;border-radius:999px;background:var(--primary);color:#fff;padding:13px 18px;margin-top:5px;font:800 13px Inter,sans-serif;cursor:pointer;transition:.2s}
        .submit-btn:hover{background:var(--primary-dark);transform:translateY(-1px)}
        .form-note{font-size:11px;color:var(--muted);margin-top:15px;text-align:center}
        .footer{font-size:10px;color:#9a9189;text-align:center;margin-top:18px}
        @media(max-width:560px){body{padding:20px 12px}.register-card{padding:22px 18px;border-radius:18px}h1{font-size:22px}.form-grid{grid-template-columns:1fr;gap:0}.intro{font-size:12px}}
    </style>
</head>
<body>
<div class="register-wrap">
    <a href="/" class="top-link"><span class="material-symbols-outlined" style="font-size:17px">arrow_back</span>Kembali ke Marketplace</a>

    <main class="register-card">
        <div class="brand-mark"><span class="material-symbols-outlined">storefront</span></div>
        <h1>Daftar Menjadi Penjual</h1>
        <p class="intro">Lengkapi informasi toko kamu. Pengajuan akan diperiksa terlebih dahulu oleh Admin PinTa.</p>

        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        @if($registration && $registration->status === 'pending')
            <div class="alert alert-warning"><strong>Pengajuan sedang ditinjau.</strong><br>Pengajuan kamu sedang menunggu persetujuan Admin.</div>
        @elseif($registration && $registration->status === 'rejected')
            <div class="alert alert-error"><strong>Pengajuan sebelumnya ditolak.</strong><br>Alasan: {{ $registration->rejection_reason ?? 'Tidak disebutkan.' }}<br>Kamu dapat mengajukan kembali dengan memperbarui informasi di bawah.</div>
        @endif

        @if(!$registration || $registration->status !== 'pending')
            <form action="{{ route('seller.register.store') }}" method="POST">
                @csrf
                <div class="form-grid">
                    <div class="field" style="grid-column:1/-1">
                        <label for="store_name">Nama Toko</label>
                        <input type="text" id="store_name" name="store_name" value="{{ old('store_name', $registration->store_name ?? '') }}" required>
                        @error('store_name')<div class="field-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="field" style="grid-column:1/-1">
                        <label for="description">Deskripsi Toko</label>
                        <textarea id="description" name="description" placeholder="Ceritakan secara singkat toko dan produk yang akan kamu jual...">{{ old('description', $registration->description ?? '') }}</textarea>
                        @error('description')<div class="field-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="field" style="grid-column:1/-1">
                        <label for="phone">Nomor Telepon Toko</label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone', $registration->phone ?? '') }}" required>
                        @error('phone')<div class="field-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="field" style="grid-column:1/-1">
                        <label for="address">Alamat Toko</label>
                        <textarea id="address" name="address" required>{{ old('address', $registration->address ?? '') }}</textarea>
                        @error('address')<div class="field-error">{{ $message }}</div>@enderror
                    </div>
                </div>

                <button type="submit" class="submit-btn"><span class="material-symbols-outlined" style="font-size:18px">send</span>Kirim Pengajuan</button>
                <p class="form-note">Pastikan informasi yang kamu masukkan sudah benar sebelum dikirim.</p>
            </form>
        @endif
    </main>
    <p class="footer">© {{ date('Y') }} PinTa Marketplace · Seller Registration</p>
</div>
</body>
</html>
