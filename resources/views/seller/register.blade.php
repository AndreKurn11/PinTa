
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Menjadi Penjual</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 30px 15px;
            font-family: Arial, sans-serif;
            background: #f4f6f9;
        }

        .container {
            max-width: 600px;
            margin: auto;
            padding: 30px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,.08);
        }

        h1 {
            margin-top: 0;
            color: #222;
        }

        label {
            display: block;
            margin-top: 18px;
            margin-bottom: 7px;
            font-weight: bold;
        }

        input, textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 7px;
            font-size: 15px;
        }

        textarea {
            min-height: 100px;
            resize: vertical;
        }

        button {
            width: 100%;
            margin-top: 25px;
            padding: 13px;
            border: none;
            border-radius: 7px;
            background: #2563eb;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background: #1d4ed8;
        }

        .error {
            color: #dc2626;
            font-size: 14px;
            margin-top: 5px;
        }

        .alert {
            padding: 12px;
            border-radius: 7px;
            margin-bottom: 15px;
            background: #fef3c7;
            color: #92400e;
        }

        .back {
            display: inline-block;
            margin-top: 20px;
            color: #2563eb;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="container">

    <h1>Daftar Menjadi Penjual</h1>

    <p>
        Lengkapi informasi toko kamu. Pengajuan akan diperiksa
        terlebih dahulu oleh Admin.
    </p>

    @if(session('error'))
        <div class="alert">
            {{ session('error') }}
        </div>
    @endif

    @if($registration && $registration->status === 'pending')
        <div class="alert">
            Pengajuan kamu sedang menunggu persetujuan Admin.
        </div>
    @elseif($registration && $registration->status === 'rejected')
        <div class="alert">
            Pengajuan sebelumnya ditolak.
            Alasan: {{ $registration->rejection_reason ?? 'Tidak disebutkan.' }}
            <br>
            Kamu dapat mengajukan kembali.
        </div>
    @endif

    @if(!$registration || $registration->status !== 'pending')
        <form action="{{ route('seller.register.store') }}" method="POST">
            @csrf

            <label for="store_name">Nama Toko</label>
            <input
                type="text"
                id="store_name"
                name="store_name"
                value="{{ old('store_name', $registration->store_name ?? '') }}"
                required
            >
            @error('store_name')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="description">Deskripsi Toko</label>
            <textarea
                id="description"
                name="description"
            >{{ old('description', $registration->description ?? '') }}</textarea>
            @error('description')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="phone">Nomor Telepon Toko</label>
            <input
                type="text"
                id="phone"
                name="phone"
                value="{{ old('phone', $registration->phone ?? '') }}"
                required
            >
            @error('phone')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="address">Alamat Toko</label>
            <textarea
                id="address"
                name="address"
                required
            >{{ old('address', $registration->address ?? '') }}</textarea>
            @error('address')
                <div class="error">{{ $message }}</div>
            @enderror

            <button type="submit">
                Kirim Pengajuan
            </button>
        </form>
    @endif

    <a href="/" class="back">← Kembali ke Marketplace</a>

</div>

</body>
</html>
