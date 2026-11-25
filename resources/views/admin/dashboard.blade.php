@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('page-heading', 'Dashboard Administrator')

@section('content')
<div class="page-title">
    <h1>Selamat datang, {{ auth()->user()->name }} 👋</h1>
    <p>Ringkasan pengelolaan marketplace PinTa hari ini.</p>
</div>

<section class="stat-grid" style="display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:15px;margin-bottom:18px">
    <article class="panel" style="display:flex;align-items:center;gap:15px">
        <span style="width:48px;height:48px;flex:0 0 48px;border-radius:15px;background:#f7eee8;color:#89563f;display:grid;place-items:center"><span class="material-symbols-outlined">group</span></span>
        <div><p class="subtext" style="font-size:11px;font-weight:700">Total Pengguna</p><h2 style="font-size:25px;letter-spacing:-1px">—</h2><p class="subtext">Belum terhubung ke database</p></div>
    </article>
    <article class="panel" style="display:flex;align-items:center;gap:15px">
        <span style="width:48px;height:48px;flex:0 0 48px;border-radius:15px;background:#e9f5ed;color:#247a50;display:grid;place-items:center"><span class="material-symbols-outlined">inventory_2</span></span>
        <div><p class="subtext" style="font-size:11px;font-weight:700">Total Produk</p><h2 style="font-size:25px;letter-spacing:-1px">—</h2><p class="subtext">Belum terhubung ke database</p></div>
    </article>
    <article class="panel" style="display:flex;align-items:center;gap:15px">
        <span style="width:48px;height:48px;flex:0 0 48px;border-radius:15px;background:#fff4df;color:#9a6418;display:grid;place-items:center"><span class="material-symbols-outlined">receipt_long</span></span>
        <div><p class="subtext" style="font-size:11px;font-weight:700">Total Pesanan</p><h2 style="font-size:25px;letter-spacing:-1px">—</h2><p class="subtext">Belum terhubung ke database</p></div>
    </article>
    <article class="panel" style="display:flex;align-items:center;gap:15px">
        <span style="width:48px;height:48px;flex:0 0 48px;border-radius:15px;background:#f1ecf8;color:#76549a;display:grid;place-items:center"><span class="material-symbols-outlined">storefront</span></span>
        <div><p class="subtext" style="font-size:11px;font-weight:700">Pendaftaran Penjual</p><h2 style="font-size:25px;letter-spacing:-1px">—</h2><p class="subtext">Belum terhubung ke database</p></div>
    </article>
</section>

<section class="panel">
    <div class="panel-heading">
        <div><h2>Panel Administrator PinTa</h2><p>Kelola aktivitas dan pengajuan penjual melalui satu tempat.</p></div>
        <span class="status status-approved">Panel aktif</span>
    </div>
    <p style="font-size:13px;color:#817a74;line-height:1.8">Melalui halaman ini, administrator dapat memantau pengguna, produk, pesanan, dan pendaftaran penjual. Saat ini, fitur yang sudah tersedia adalah pemeriksaan pengajuan pendaftaran penjual.</p>
    <div style="margin-top:18px">
        <a class="btn" href="{{ route('admin.seller-registrations.index') }}"><span class="material-symbols-outlined" style="font-size:17px">how_to_reg</span>Lihat Pengajuan Penjual</a>
    </div>
</section>

<style>
@media(max-width:680px){.stat-grid{grid-template-columns:1fr!important}}
</style>
@endsection
