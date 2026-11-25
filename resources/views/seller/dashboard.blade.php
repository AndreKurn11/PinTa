@extends('layouts.seller')

@section('title', 'Dashboard Penjual')

@section('content')
<div class="page-title">
    <h1>Dashboard Penjual 👋</h1>
    <p>Selamat datang di Seller Center PinTa. Berikut ringkasan tokomu.</p>
</div>

<section class="card">
    <div class="card-heading">
        <div>
            <h2>{{ $store->store_name }}</h2>
            <p>Informasi utama toko yang terdaftar di marketplace PinTa.</p>
        </div>
        @if($store->status === 'active')
            <span class="status status-active">Aktif</span>
        @else
            <span class="status status-inactive">Tidak Aktif</span>
        @endif
    </div>

    <p>{{ $store->description ?? 'Belum ada deskripsi toko.' }}</p>

    <div class="store-details">
        <div class="detail-item"><div class="detail-label">Nomor Telepon</div><div class="detail-value">{{ $store->phone }}</div></div>
        <div class="detail-item"><div class="detail-label">Slug Toko</div><div class="detail-value">{{ $store->slug }}</div></div>
        <div class="detail-item" style="grid-column:1/-1"><div class="detail-label">Alamat Toko</div><div class="detail-value">{{ $store->address }}</div></div>
    </div>
</section>

<div class="card-heading" style="margin:4px 2px 10px">
    <div><h2 style="font-size:17px">Ringkasan Toko</h2><p class="muted" style="font-size:11px;margin-top:3px">Ikhtisar aktivitas tokomu.</p></div>
</div>

<section class="stats">
    <article class="stat-card">
        <span class="stat-icon"><span class="material-symbols-outlined">inventory_2</span></span>
        <h3>Produk</h3>
        <h2>Belum tersedia</h2>
        <p>Akan dihitung setelah modul produk dibuat.</p>
    </article>
    <article class="stat-card">
        <span class="stat-icon" style="background:#e9f5ed;color:#247a50"><span class="material-symbols-outlined">receipt_long</span></span>
        <h3>Pesanan</h3>
        <h2>Belum tersedia</h2>
        <p>Akan tersedia pada tahap pengelolaan pesanan.</p>
    </article>
    <article class="stat-card">
        <span class="stat-icon" style="background:#fff4df;color:#9a6418"><span class="material-symbols-outlined">verified</span></span>
        <h3>Status Toko</h3>
        <h2>{{ ucfirst($store->status) }}</h2>
        <p>Status toko yang tercatat di sistem.</p>
    </article>
</section>

<section class="card">
    <div class="card-heading">
        <div><h2>Mulai Kelola Toko</h2><p>Langkah berikutnya untuk mengembangkan tokomu.</p></div>
        <span class="material-symbols-outlined" style="font-size:26px;color:#89563f">rocket_launch</span>
    </div>
    <p>Kamu sudah terdaftar sebagai penjual. Selanjutnya, kamu dapat menyiapkan produk untuk ditampilkan di marketplace PinTa.</p>
    <div style="margin-top:17px">
        <a href="{{ route('seller.products.index') }}" class="btn"><span class="material-symbols-outlined" style="font-size:17px">inventory_2</span>Kelola Produk</a>
    </div>
</section>
@endsection
