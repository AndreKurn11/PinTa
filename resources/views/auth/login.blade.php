
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - PinTa Marketplace</title>

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
            padding: 20px;
        }

        /* LOGIN CONTAINER */
        .login-container {
            width: 100%;
            max-width: 420px;
            background: #ffffff;
            padding: 40px 35px;
            border-radius: 14px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        }

        /* HEADER */
        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo {
            font-size: 32px;
            font-weight: bold;
            color: #2563eb;
            margin-bottom: 10px;
        }

        .login-header h1 {
            font-size: 24px;
            color: #1e293b;
            margin-bottom: 8px;
        }

        .login-header p {
            font-size: 14px;
            color: #64748b;
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
            margin-bottom: 20px;
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
        .btn-login {
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

        .btn-login:hover {
            background: #1d4ed8;
        }

        /* REGISTER LINK */
        .register-link {
            text-align: center;
            margin-top: 25px;
            font-size: 14px;
            color: #64748b;
        }

        .register-link a {
            color: #2563eb;
            font-weight: 600;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        /* BACK TO HOME */
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
            .login-container {
                padding: 30px 22px;
            }

            .login-header h1 {
                font-size: 21px;
            }
        }
    </style>

</head>

<body>

    <div class="login-container">

        {{-- HEADER --}}
        <div class="login-header">

            <div class="logo">
                PinTa
            </div>

            <h1>Selamat Datang!</h1>

            <p>Silakan login untuk melanjutkan ke marketplace.</p>

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


        {{-- LOGIN FORM --}}
        <form action="{{ route('login.store') }}" method="POST">

            @csrf

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
                    required
                    autofocus
                >

            </div>


            <div class="form-group">

                <label for="password">
                    Password
                </label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Masukkan password"
                    autocomplete="current-password"
                    required
                >

            </div>


            <button type="submit" class="btn-login">
                Login
            </button>

        </form>


        {{-- REGISTER LINK --}}
        <div class="register-link">

            Belum memiliki akun?

            <a href="{{ route('register') }}">
                Daftar sekarang
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
