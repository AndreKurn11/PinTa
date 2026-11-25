@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('page-heading', 'Dashboard Administrator')

@section('content')

    <div class="page-title">

        <h1>Selamat Datang, {{ auth()->user()->name }}!</h1>

        <p>
            Berikut adalah halaman pengelolaan marketplace PinTa.
        </p>
    </div>


    {{-- STATISTIK --}}
    <div class="stat-grid">

        <div class="stat-card">
            <div class="stat-icon blue">👥</div>
            <div>
                <p>Total Pengguna</p>
                <h2>—</h2>
                <small>Belum terhubung ke database</small>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon green">🛍️</div>
            <div>
                <p>Total Produk</p>
                <h2>—</h2>
                <small>Belum terhubung ke database</small>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon orange">📦</div>
            <div>
                <p>Total Pesanan</p>
                <h2>—</h2>
                <small>Belum terhubung ke database</small>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon purple">🏪</div>
            <div>
                <p>Pendaftaran Penjual</p>
                <h2>—</h2>
                <small>Belum terhubung ke database</small>
            </div>
        </div>

    </div>


    {{-- INFORMASI --}}
    <div class="welcome-card">

        <h2>Panel Administrator PinTa</h2>

        <p>
            Melalui halaman ini, administrator dapat mengelola
            pengguna, produk, pesanan, dan pendaftaran penjual.
        </p>

        <p>
            Fitur pengelolaan akan dikembangkan pada tahap berikutnya.
        </p>

    </div>


    <style>
        .stat-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 23px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            gap: 18px;
            box-shadow: 0 2px 8px rgba(0,0,0,.04);
        }

        .stat-icon {
            width: 55px;
            height: 55px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 25px;
            flex-shrink: 0;
        }

        .blue {
            background: #dbeafe;
        }

        .green {
            background: #dcfce7;
        }

        .orange {
            background: #ffedd5;
        }

        .purple {
            background: #f3e8ff;
        }

        .stat-card p {
            color: #64748b;
            font-size: 13px;
            margin-bottom: 7px;
        }

        .stat-card h2 {
            font-size: 26px;
            color: #1e293b;
            margin-bottom: 5px;
        }

        .stat-card small {
            color: #94a3b8;
            font-size: 11px;
        }

        .welcome-card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,.04);
        }

        .welcome-card h2 {
            color: #1e293b;
            margin-bottom: 12px;
        }

        .welcome-card p {
            color: #64748b;
            font-size: 14px;
            line-height: 1.7;
            margin-bottom: 8px;
        }

        @media(max-width: 700px) {
            .stat-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

@endsection