<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>403 - Akses Ditolak</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #f1f5f9;
            text-align: center;
            padding: 20px;
        }

        .container {
            background: white;
            padding: 45px;
            border-radius: 14px;
            box-shadow: 0 5px 20px rgba(0,0,0,.08);
            max-width: 450px;
        }

        h1 {
            font-size: 75px;
            color: #dc2626;
            margin-bottom: 10px;
        }

        h2 {
            color: #1e293b;
            margin-bottom: 12px;
        }

        p {
            color: #64748b;
            margin-bottom: 25px;
            line-height: 1.6;
        }

        a {
            display: inline-block;
            padding: 12px 20px;
            background: #2563eb;
            color: white;
            text-decoration: none;
            border-radius: 7px;
        }
    </style>
</head>

<body>

    <div class="container">

        <h1>403</h1>

        <h2>Akses Ditolak!</h2>

        <p>
            Maaf, Anda tidak memiliki izin untuk
            mengakses halaman ini.
        </p>

        <a href="{{ route('dashboard') }}">
            Kembali ke Dashboard
        </a>

    </div>

</body>
</html>