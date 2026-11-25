<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Akun PINTA — PinTa</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
    :root{--primary:#8f563b;--primary-dark:#74432f;--primary-soft:#f3e6de;--surface:#fff;--page:#f5f4f2;--text:#292521;--muted:#817971;--line:#e9e4df;--danger:#a12622;--success:#216b43}
    *{box-sizing:border-box;margin:0;padding:0}
    body{min-height:100vh;background:var(--page);color:var(--text);font-family:Inter,Arial,sans-serif}
    a{color:inherit;text-decoration:none}
    button,input{font:inherit}
    .topbar{height:70px;padding:0 5.5%;display:flex;align-items:center;justify-content:space-between;background:rgba(255,255,255,.82);backdrop-filter:blur(18px);border-bottom:1px solid var(--line)}
    .back-link{display:inline-flex;align-items:center;gap:9px;padding:9px 14px;border:1px solid var(--line);border-radius:30px;background:#fff;font-size:12px;font-weight:600;color:#514a44}
    .portal-tag{display:inline-flex;align-items:center;gap:7px;padding:7px 11px;border-radius:30px;background:var(--primary-soft);color:var(--primary);font-size:10px;font-weight:700}
    .online{display:flex;align-items:center;gap:8px;padding:8px 12px;border:1px solid var(--line);border-radius:30px;background:#fff;color:#6b655f;font-size:11px}
    .online i{width:7px;height:7px;border-radius:50%;background:#319568;display:inline-block;box-shadow:0 0 0 4px #31956820}
    .auth-shell{max-width:1360px;margin:0 auto;padding:26px 28px;min-height:calc(100vh - 132px);display:grid;grid-template-columns:minmax(330px,.88fr) minmax(430px,1.12fr);gap:24px;align-items:stretch}
    .showcase{position:relative;overflow:hidden;border-radius:22px;background:linear-gradient(145deg,#75432f,#965b40 62%,#b47b5d);color:#fff;padding:38px;display:flex;flex-direction:column;justify-content:space-between;min-height:690px;box-shadow:0 8px 28px #5c38251a}
    .showcase:before,.showcase:after{content:"";position:absolute;border:1px solid #ffffff22;border-radius:50%;pointer-events:none}
    .showcase:before{width:430px;height:430px;right:-210px;top:80px;box-shadow:0 0 0 34px #ffffff09,0 0 0 75px #ffffff07}
    .showcase:after{width:260px;height:260px;left:-160px;bottom:100px}
    .brand{position:relative;z-index:1;display:flex;align-items:center;gap:12px}
    .brand-mark{width:46px;height:46px;border-radius:13px;display:grid;place-items:center;background:#00000026;border:1px solid #ffffff3d;font-size:24px;font-weight:800}
    .brand-name{font-size:21px;font-weight:800;letter-spacing:1px}
    .brand-sub{margin-top:3px;color:#f3dfd3;font-size:11px}
    .showcase-copy{position:relative;z-index:1;margin:38px 0}
    .eyebrow{display:inline-flex;align-items:center;gap:7px;padding:7px 11px;border:1px solid #ffffff35;border-radius:30px;background:#00000020;font-size:10px;font-weight:700}
    .showcase h1{max-width:520px;margin:18px 0 13px;font-size:clamp(30px,3.2vw,43px);line-height:1.14;letter-spacing:-1.4px}
    .showcase-copy p{max-width:500px;color:#fff0e8;font-size:13px;line-height:1.8}
    .visual{position:relative;z-index:1;min-height:190px;border:1px solid #ffffff30;border-radius:17px;background:linear-gradient(135deg,#ffffff1c,#00000016);display:flex;align-items:center;justify-content:center;overflow:hidden}
    .visual-art{display:flex;align-items:center;gap:18px;color:#fff}
    .visual-art .book{width:100px;height:125px;border-radius:8px 13px 13px 8px;background:linear-gradient(135deg,#f8eee6,#d8bda9);box-shadow:12px 12px 25px #30180f40;transform:rotate(-8deg);display:grid;place-items:center;color:#8c553c;font-size:40px}
    .visual-art .tablet{width:125px;height:95px;border:7px solid #342d2a;border-radius:12px;background:#e9d9ca;display:grid;place-items:center;color:#8c553c;font-size:32px;transform:rotate(7deg)}
    .showcase-foot{position:relative;z-index:1;padding-top:17px;border-top:1px solid #ffffff35;display:flex;justify-content:space-between;gap:12px;color:#fff4ed;font-size:10px}
    .auth-side{display:flex;align-items:center;justify-content:center;padding:10px}
    .auth-card{width:100%;max-width:570px;padding:32px;background:var(--surface);border:1px solid var(--line);border-radius:20px;box-shadow:0 8px 30px #38271b0b}
    .auth-card h2{font-size:24px;letter-spacing:-.7px;margin-bottom:7px}
    .intro{font-size:12px;line-height:1.6;color:var(--muted);margin-bottom:24px}
    .alert{padding:12px 14px;border-radius:11px;margin-bottom:17px;font-size:12px;line-height:1.6}
    .alert-success{background:#edf8f0;border:1px solid #c7e6d0;color:var(--success)}
    .alert-error{background:#fff0ef;border:1px solid #f1cfcc;color:var(--danger)}
    .alert ul{padding-left:18px}
    .field{margin-bottom:17px}
    .field label{display:block;margin-bottom:7px;color:#6f6861;font-size:10px;font-weight:800;letter-spacing:.75px;text-transform:uppercase}
    .input-wrap{position:relative}
    .field input{width:100%;height:46px;padding:0 14px;border:1px solid transparent;border-radius:10px;background:#f4f2f0;color:var(--text);font-size:13px;outline:none;transition:.2s}
    .field input:focus{background:#fff;border-color:#c69b83;box-shadow:0 0 0 4px #8f563b12}
    .field input::placeholder{color:#aaa19a}
    .input-wrap.has-toggle input{padding-right:48px}
    .toggle-password{position:absolute;right:12px;top:50%;transform:translateY(-50%);border:0;background:none;color:#827970;cursor:pointer;font-size:11px}
    .submit{width:100%;height:48px;margin-top:5px;border:0;border-radius:30px;background:var(--primary);color:white;font-size:13px;font-weight:700;cursor:pointer;box-shadow:0 5px 13px #8f563b25;transition:.2s}
    .submit:hover{background:var(--primary-dark);transform:translateY(-1px)}
    .auth-switch{margin-top:22px;padding-top:18px;border-top:1px solid var(--line);text-align:center;color:var(--muted);font-size:12px}
    .auth-switch a{color:var(--primary);font-weight:800;margin-left:4px}
    .auth-switch a:hover{text-decoration:underline}
    .bottom{min-height:62px;padding:15px 5.5%;display:flex;align-items:center;justify-content:space-between;gap:15px;background:#ffffffa8;border-top:1px solid var(--line);color:#827a73;font-size:10px}
    .bottom strong{color:#4e4842}
    @media(max-width:900px){.auth-shell{grid-template-columns:1fr;max-width:680px;min-height:auto;padding:20px 18px}.showcase{min-height:auto;padding:25px;border-radius:18px}.showcase-copy{margin:25px 0 18px}.showcase h1{font-size:30px}.visual{display:none}.showcase-foot{margin-top:5px}.auth-side{padding:0}.auth-card{max-width:none}.topbar{padding:0 18px}.portal-tag{display:none}.bottom{padding:14px 18px;flex-wrap:wrap}}
    @media(max-width:520px){.topbar{height:60px}.online{font-size:0;padding:9px}.online i{margin:0}.auth-shell{padding:14px 12px 24px;gap:14px}.showcase{padding:21px}.showcase h1{font-size:26px}.showcase-copy p{font-size:12px}.showcase-foot{font-size:9px}.auth-card{padding:23px 18px;border-radius:17px}.auth-card h2{font-size:21px}.bottom{justify-content:center;text-align:center}}
</style>
</head>
<body>
    <header class="topbar">
        <a href="{{ route('dashboard') }}" class="back-link"><span>←</span> Kembali ke Pasar PINTA</a>
        <span class="portal-tag">✦ &nbsp; Portal Autentikasi Mahasiswa Jambi</span>
        <span class="online"><i></i> Portal aktif</span>
    </header>

    <main class="auth-shell">
        <section class="showcase">
            <div>
                <a href="{{ route('dashboard') }}" class="brand">
                    <div class="brand-mark">P</div>
                    <div><div class="brand-name">PINTA</div><div class="brand-sub">Pindah Tangan Mahasiswa Jambi</div></div>
                </a>
                <div class="showcase-copy">
                    <span class="eyebrow">✦ &nbsp; Komunitas Kampus Terpercaya</span>
                    <h1>Beri Nilai Baru pada Barang Bekasmu.</h1>
                    <p>Platform jual beli langsung, barter antar mahasiswa, dan lelang transparan untuk komunitas kampus serta warga Kota Jambi.</p>
                </div>
                <div class="visual" aria-hidden="true">
                    <div class="visual-art"><div class="book">▤</div><div class="tablet">▣</div></div>
                </div>
            </div>
            <div class="showcase-foot">
                <span>♧ &nbsp; UNJA Mendalo &amp; Telanaipura</span>
                <span>◇ &nbsp; Komunitas Kampus Jambi</span>
            </div>
        </section>

        <section class="auth-side">
            <div class="auth-card">
                @if (session('success'))
                    <div class="alert alert-success">{ session('success') }</div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-error">
                        <strong>Periksa kembali data yang dimasukkan.</strong>
                        <ul>@foreach ($errors->all() as $error)<li>{ $error }</li>@endforeach</ul>
                    </div>
                @endif
                <h2>Buat Akun PINTA</h2>
                <p class="intro">Bergabung dengan komunitas jual beli, barter, dan lelang mahasiswa di Jambi.<br>Lengkapi data berikut untuk membuat akun PinTa.</p>

                <form action="{{ route('register.store') }}" method="POST">
                    @csrf

            <div class="field">
                <label for="name">Nama Lengkap</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="Masukkan nama lengkap" autocomplete="name" maxlength="100" required autofocus>
                @error('name') <small style="display:block;color:#a12622;margin-top:5px">{{ $message }}</small> @enderror
            </div>

            <div class="field">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" autocomplete="email" maxlength="150" required >
                @error('email') <small style="display:block;color:#a12622;margin-top:5px">{{ $message }}</small> @enderror
            </div>

            <div class="field">
                <label for="password">Kata Sandi</label>
                <div class="input-wrap has-toggle">
                    <input id="password" type="password" name="password" placeholder="Minimal 8 karakter" autocomplete="new-password" minlength="8" required>
                    <button class="toggle-password" type="button" data-target="password">Lihat</button>
                </div>
                @error('password') <small style="display:block;color:#a12622;margin-top:5px">{{ $message }}</small> @enderror
            </div>

            <div class="field">
                <label for="password_confirmation">Konfirmasi Kata Sandi</label>
                <div class="input-wrap has-toggle">
                    <input id="password_confirmation" type="password" name="password_confirmation" placeholder="Ulangi kata sandi" autocomplete="new-password" required>
                    <button class="toggle-password" type="button" data-target="password_confirmation">Lihat</button>
                </div>
            </div>

                    <button type="submit" class="submit">Daftar Sekarang&nbsp; →</button>
                </form>

                <div class="auth-switch">Sudah memiliki akun PINTA? <a href="{{ route('login') }}">Masuk di sini</a></div>
            </div>
        </section>
    </main>

    <footer class="bottom">
        <span><strong>♧ Data akun kamu dijaga dengan aman</strong> &nbsp; • &nbsp; Portal PinTa Jambi</span>
        <span><a href="{{ route('dashboard') }}">Kembali ke Beranda</a> &nbsp; • &nbsp; © {{ date('Y') }} PINTA</span>
    </footer>
    <script>
        document.querySelectorAll('.toggle-password').forEach(function(button) {
            button.addEventListener('click', function() {
                const input = document.getElementById(this.dataset.target);
                const show = input.type === 'password';
                input.type = show ? 'text' : 'password';
                this.textContent = show ? 'Sembunyikan' : 'Lihat';
            });
        });
    </script>
</body>
</html>
