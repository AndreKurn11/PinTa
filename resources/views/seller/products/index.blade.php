@extends('layouts.seller')

@section('title', 'Kelola Produk')

@section('content')
<div class="page-title">
    <h1>Pengelolaan Produk</h1>
    <p>Kelola produk yang akan ditampilkan di marketplace PinTa.</p>
</div>

<section class="card">
    <div class="card-heading">
        <div><h2>{{ $store->store_name }}</h2><p>Halaman pengelolaan produk milik tokomu.</p></div>
        @if($store->status === 'active')
            <span class="status status-active">Toko Aktif</span>
        @else
            <span class="status status-inactive">{{ ucfirst($store->status) }}</span>
        @endif
    </div>
    <div class="store-details">
        <div class="detail-item"><div class="detail-label">Nama Toko</div><div class="detail-value">{{ $store->store_name }}</div></div>
        <div class="detail-item"><div class="detail-label">Status Toko</div><div class="detail-value">{{ ucfirst($store->status) }}</div></div>
    </div>
</section>

<section class="card">
    <div class="card-heading">
        <div><h2>Daftar Produk</h2><p>Produk yang kamu kelola akan ditampilkan di bagian ini.</p></div>
        <button class="btn" type="button" disabled><span class="material-symbols-outlined" style="font-size:17px">add</span>Tambah Produk (Segera Hadir)</button>
    </div>
    <div class="empty-state">
        <span class="material-symbols-outlined">inventory_2</span>
        <div style="font-weight:800;color:#514a44">Belum ada data produk</div>
        Modul produk akan diaktifkan setelah tabel dan model produk selesai dibuat.
    </div>
</section>
@endsection
