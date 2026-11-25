
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register - PinTa Marketplace</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #f1f5f9;
            padding: 25px 20px;
        }

        /* REGISTER CONTAINER */
        .register-container {
            width: 100%;
            max-width: 450px;
            background: #ffffff;
            padding: 38px 35px;
            border-radius: 14px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        }

        /* HEADER */
        .register-header {
            text-align: center;
            margin-bottom: 28px;
        }

        .logo {
            font-size: 32px;
            font-weight: bold;
            color: #2563eb;
            margin-bottom: 10px;
        }

        .register-header h1 {
            font-size: 24px;
            color: #1e293b;
            margin-bottom: 8px;
        }

        .register-header p {
            font-size: 14px;
            color: #64748b;
            line-height: 1.5;
        }

        /* ALERT */
        .alert-success {
            background: #dcfce7;
            color: #166534;
            padding: 12px;
            border-radius: 7px;
            font-size: 13px;
            margin-bottom: 20px;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            padding: 12px 15px;
            border-radius: 7px;
            font-size: 13px;
            margin-bottom: 20px;
        }

        .alert-error ul {
            padding-left: 18px;
        }

        /* FORM */
        .form-group {
            margin-bottom: 19px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #334155;
            margin-bottom: 8px;
        }

        .form-group input {
            width: 100%;
            padding: 13px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 7px;
            font-size: 14px;
            outline: none;
            transition: 0.2s;
        }

        .form-group input:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
        }

        .form-group input::placeholder {
            color: #94a3b8;
        }

        /* BUTTON */
        .btn-register {
            width: 100%;
            padding: 13px;
            border: none;
            border-radius: 7px;
            background: #2563eb;
            color: white;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-register:hover {
            background: #1d4ed8;
        }

        /* LOGIN LINK */
        .login-link {
            text-align: center;
            margin-top: 24px;
            font-size: 14px;
            color: #64748b;
        }

        .login-link a {
            color: #2563eb;
            font-weight: 600;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        /* BACK HOME */
        .back-home {
            text-align: center;
            margin-top: 20px;
        }

        .back-home a {
            color: #64748b;
            text-decoration: none;
            font-size: 13px;
        }

        .back-home a:hover {
            color: #2563eb;
        }

        /* RESPONSIVE */
        @media (max-width: 480px) {
            .register-container {
                padding: 30px 22px;
            }

            .register-header h1 {
                font-size: 21px;
            }
        }
    </style>

</head>

<body>

    <div class="register-container">

        {{-- HEADER --}}
        <div class="register-header">

            <div class="logo">
                PinTa
            </div>

            <h1>Buat Akun Baru</h1>

            <p>
                Daftarkan akun Anda untuk mulai berbelanja
                di marketplace PinTa.
            </p>

        </div>


        {{-- SUCCESS MESSAGE --}}
        @if (session('success'))

            <div class="alert-success">
                {{ session('success') }}
            </div>

        @endif


        {{-- ERROR MESSAGE --}}
        @if ($errors->any())

            <div class="alert-error">

                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

            </div>

        @endif


        {{-- REGISTER FORM --}}
        <form action="{{ route('register.store') }}" method="POST">

            @csrf

            {{-- NAMA LENGKAP --}}
            <div class="form-group">

                <label for="name">
                    Nama Lengkap
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Masukkan nama lengkap"
                    autocomplete="name"
                    maxlength="100"
                    required
                    autofocus
                >

            </div>


            {{-- EMAIL --}}
            <div class="form-group">

                <label for="email">
                    Email
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Masukkan email"
                    autocomplete="email"
                    maxlength="150"
                    required
                >

            </div>


            {{-- PASSWORD --}}
            <div class="form-group">

                <label for="password">
                    Password
                </label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Minimal 8 karakter"
                    autocomplete="new-password"
                    minlength="8"
                    required
                >

            </div>


            {{-- KONFIRMASI PASSWORD --}}
            <div class="form-group">

                <label for="password_confirmation">
                    Konfirmasi Password
                </label>

                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="Masukkan ulang password"
                    autocomplete="new-password"
                    required
                >

            </div>


            {{-- SUBMIT BUTTON --}}
            <button type="submit" class="btn-register">
                Daftar Sekarang
            </button>

        </form>


        {{-- LOGIN LINK --}}
        <div class="login-link">

            Sudah memiliki akun?

            <a href="{{ route('login') }}">
                Login di sini
            </a>

        </div>


        {{-- BACK TO HOME --}}
        <div class="back-home">

            <a href="{{ route('dashboard') }}">
                ← Kembali ke Beranda
            </a>

        </div>

    </div>

</body>
</html>
