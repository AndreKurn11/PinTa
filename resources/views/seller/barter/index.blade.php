@extends('layouts.seller')

@section('title', 'Kelola Pengajuan Barter')

@section('styles')
<style>
    .barter-filters{display:flex;gap:8px;flex-wrap:wrap;margin:18px 0}
    .barter-filter{padding:9px 15px;border:1px solid var(--line);border-radius:999px;color:#70657b;text-decoration:none;font-size:12px;font-weight:700;background:#fff}
    .barter-filter.active{background:#7542a8;color:#fff;border-color:#7542a8}
    .barter-row{display:grid;grid-template-columns:76px minmax(0,1fr) auto;gap:16px;align-items:center;border-top:1px solid var(--line);padding:18px 0}
    .barter-photo{width:76px;height:76px;object-fit:cover;border-radius:12px;background:#f4f0ed;display:grid;place-items:center;color:#93877d}
    .barter-row h3{font-size:15px;margin:6px 0;color:var(--ink);overflow-wrap:anywhere}
    .barter-row p{font-size:12px;color:var(--muted);margin:5px 0;overflow-wrap:anywhere}
    .barter-tag{display:inline-block;border-radius:999px;background:#f3eafb;color:#7542a8;padding:5px 10px;font-size:11px;font-weight:700}
    .barter-btn{display:inline-flex;align-items:center;justify-content:center;padding:10px 15px;border-radius:999px;background:#7542a8;color:#fff;text-decoration:none;border:0;font:inherit;font-size:12px;font-weight:700;cursor:pointer}
    .barter-actions{text-align:right;display:grid;gap:8px;justify-items:end}
    .barter-pages{display:flex;justify-content:space-between;align-items:center;margin-top:18px;font-size:12px}
    @media(max-width:600px){.barter-row{grid-template-columns:60px minmax(0,1fr)}.barter-photo{width:60px;height:60px}.barter-actions{grid-column:2;justify-items:start;text-align:left}}
</style>
@endsection

@section('content')
@php
    $labels = ['pending'=>'Menunggu','accepted'=>'Diterima','rejected'=>'Ditolak','cancelled'=>'Dibatalkan','expired'=>'Tidak berlaku'];
    $types = ['item'=>'Barter murni','mixed'=>'Tukar tambah','cash'=>'Tawaran tunai'];
@endphp
<div class="page-title">
    <h1>Kelola Pengajuan Barter</h1>
    <p>Periksa barang dan penawaran yang masuk untuk produk milik tokomu.</p>
</div>
<section class="card">
    <div class="card-heading"><div><h2>Penawaran Masuk</h2><p>Terima atau tolak penawaran sesuai kesepakatan.</p></div><span class="barter-tag">{{ $counts->get('pending', 0) }} Menunggu</span></div>
    <div class="barter-filters">
        <a class="barter-filter {{ !$status ? 'active' : '' }}" href="{{ route('seller.barter.index') }}">Semua ({{ $counts->sum() }})</a>
        @foreach($labels as $key => $label)
            <a class="barter-filter {{ $status === $key ? 'active' : '' }}" href="{{ route('seller.barter.index', ['status'=>$key]) }}">{{ $label }} ({{ $counts->get($key, 0) }})</a>
        @endforeach
    </div>
    @forelse($offers as $offer)
        <article class="barter-row">
            @if($offer->listing->primaryImage)
                <img class="barter-photo" src="{{ asset('storage/'.$offer->listing->primaryImage->image_path) }}" alt="Foto produk">
            @else
                <div class="barter-photo"><span class="material-symbols-outlined">inventory_2</span></div>
            @endif
            <div>
                <span class="barter-tag">{{ $types[$offer->offer_type] ?? $offer->offer_type }}</span>
                <h3>{{ $offer->listing->title }}</h3>
                <p>{{ $offer->offerer->name }} · {{ $offer->created_at->format('d/m/Y H:i') }}</p>
                <p>Tawaran: {{ $offer->items->pluck('item_name')->join(', ') ?: 'Tunai' }} · Rp{{ number_format($offer->cash_amount, 0, ',', '.') }}</p>
            </div>
            <div class="barter-actions"><span class="barter-tag">{{ $labels[$offer->status] ?? $offer->status }}</span><a class="barter-btn" href="{{ route('seller.barter.show', $offer->id) }}">Lihat Detail</a></div>
        </article>
    @empty
        <p style="padding:24px 0;color:var(--muted)">Belum ada penawaran barter pada filter ini.</p>
    @endforelse
    <div class="barter-pages">
        @if($offers->previousPageUrl())<a href="{{ $offers->previousPageUrl() }}">Sebelumnya</a>@else<span></span>@endif
        <span>Halaman {{ $offers->currentPage() }} / {{ $offers->lastPage() }}</span>
        @if($offers->nextPageUrl())<a href="{{ $offers->nextPageUrl() }}">Berikutnya</a>@else<span></span>@endif
    </div>
</section>
@endsection
