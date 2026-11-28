@extends('layouts.seller')

@section('title', 'Detail Penawaran Barter')

@section('styles')
<style>
    .barter-grid{display:grid;grid-template-columns:minmax(0,1.4fr) minmax(0,1fr);gap:16px;align-items:start}
    .barter-item{display:flex;gap:14px;align-items:flex-start;padding:15px 0;border-bottom:1px solid var(--line)}
    .barter-item img{width:96px;height:96px;border-radius:12px;object-fit:cover;background:#f4f0ed}
    .barter-item h3{font-size:15px;margin:0 0 8px;overflow-wrap:anywhere}
    .barter-item p,.barter-note{font-size:12px;color:var(--muted);line-height:1.7;overflow-wrap:anywhere;white-space:pre-line}
    .barter-tag{display:inline-block;border-radius:999px;background:#f3eafb;color:#7542a8;padding:6px 12px;font-size:11px;font-weight:700}
    .barter-summary{display:grid;gap:12px;font-size:13px;margin:18px 0}
    .barter-summary div{display:flex;justify-content:space-between;gap:12px;border-bottom:1px solid var(--line);padding-bottom:10px}
    .barter-btn{display:block;width:100%;padding:12px;border:0;border-radius:999px;background:#7542a8;color:#fff;font:inherit;font-weight:700;font-size:13px;cursor:pointer;margin-top:12px}
    .barter-btn.reject{background:#fff;border:1px solid #d9a6a6;color:#a43535}
    .barter-alert{padding:14px;border-radius:12px;background:#f3eafb;color:#65428a;font-size:13px;line-height:1.6;margin:12px 0;overflow-wrap:anywhere}
    @media(max-width:800px){.barter-grid{grid-template-columns:1fr}.barter-item img{width:72px;height:72px}}
</style>
@endsection

@section('content')
@php
    $labels = ['pending'=>'Menunggu persetujuan','accepted'=>'Diterima','rejected'=>'Ditolak','cancelled'=>'Dibatalkan','expired'=>'Tidak berlaku'];
    $types = ['item'=>'Barter murni','mixed'=>'Tukar tambah','cash'=>'Tawaran tunai'];
    $conditions = ['like_new'=>'Seperti baru','good'=>'Baik','fair'=>'Cukup baik','needs_repair'=>'Perlu perbaikan'];
@endphp
<div class="page-title">
    <a href="{{ route('seller.barter.index') }}" style="color:#7542a8;text-decoration:none;font-size:13px">← Kembali ke Pengajuan Barter</a>
    <h1>Detail Penawaran #{{ $offer->id }}</h1>
    <p>Periksa barang yang ditawarkan sebelum mengambil keputusan.</p>
</div>
@if(session('success'))<div class="barter-alert" role="status">{{ session('success') }}</div>@endif
@if($errors->any())<div class="barter-alert" role="alert">{{ $errors->first() }}</div>@endif
<div class="barter-grid">
    <div>
        <section class="card">
            <div class="card-heading"><h2>Barang Milik Anda</h2><span class="barter-tag">{{ $labels[$offer->status] ?? $offer->status }}</span></div>
            <div class="barter-item">
                @if($offer->listing->primaryImage)<img src="{{ asset('storage/'.$offer->listing->primaryImage->image_path) }}" alt="Foto produk">@endif
                <div><h3>{{ $offer->listing->title }}</h3><p>{{ $offer->listing->description }}</p><p>Status: {{ $offer->listing->status }}</p></div>
            </div>
            <h2 style="font-size:16px;margin:20px 0 8px">Barang yang Ditawarkan</h2>
            @forelse($offer->items as $item)
                <div class="barter-item">
                    @if($item->image_path)<a href="{{ route('seller.barter.photo', [$offer->id, $item->id]) }}"><img src="{{ route('seller.barter.photo', [$offer->id, $item->id]) }}" alt="Foto barang tawaran"></a>@endif
                    <div><h3>{{ $item->item_name }}</h3><p>{{ $conditions[$item->item_condition] ?? $item->item_condition }} · {{ $item->offered_listing_id ? 'Dari etalase' : 'Barang baru' }}</p><p>{{ $item->description }}</p><p>Estimasi: {{ $item->estimated_value === null ? 'Tidak ditentukan' : 'Rp'.number_format($item->estimated_value, 0, ',', '.') }}</p></div>
                </div>
            @empty
                <p class="barter-note">Penawaran berupa uang saja.</p>
            @endforelse
        </section>
        <section class="card">
            <h2>Informasi Pengaju</h2>
            <p>{{ $offer->offerer->name }}</p>
            <p class="barter-note">{{ $offer->message ?: 'Tidak ada pesan.' }}</p>
            <p class="barter-note">Metode: {{ $offer->checkoutDraft->delivery_method === 'cod' ? 'COD / Bertemu langsung' : 'Pengiriman manual' }}</p>
            <p class="barter-note">Alamat / titik temu: {{ $offer->checkoutDraft->delivery_address }}</p>
            <p class="barter-note">{{ $offer->checkoutDraft->notes }}</p>
        </section>
    </div>
    <section class="card">
        <h2>Ringkasan Penawaran</h2>
        <div class="barter-summary">
            <div><span>Jenis</span><strong>{{ $types[$offer->offer_type] ?? $offer->offer_type }}</strong></div>
            <div><span>Uang yang ditawarkan</span><strong>Rp{{ number_format($offer->cash_amount, 0, ',', '.') }}</strong></div>
            <div><span>Status</span><strong>{{ $labels[$offer->status] ?? $offer->status }}</strong></div>
        </div>
        @if($offer->status === 'pending')
            <div class="barter-alert">Menerima tawaran berarti menyetujui nominal di atas. Produk akan direservasi. Pembayaran dan serah terima dilanjutkan pada tahap transaksi.</div>
            <form method="POST" action="{{ route('seller.barter.accept', $offer->id) }}">
                @csrf
                <label style="display:flex;gap:8px;font-size:12px;align-items:flex-start"><input type="checkbox" name="agreement" value="1" required> Saya menyetujui barang dan nominal penawaran ini.</label>
                <button class="barter-btn" type="submit">Terima Penawaran</button>
            </form>
            <form method="POST" action="{{ route('seller.barter.reject', $offer->id) }}" onsubmit="return confirm('Tolak penawaran ini?')">
                @csrf
                <button class="barter-btn reject" type="submit">Tolak Penawaran</button>
            </form>

        @elseif($order)

            <div class="barter-alert">

                <strong>
                    Order {{ $order->order_code }}
                </strong>

                <p>
                    Status: {{ $order->status }}
                </p>

                <p>
                    Total kewajiban tunai:

                    Rp{{ number_format(
                        $order->total_amount,
                        0,
                        ',',
                        '.'
                    ) }}
                </p>

            </div>

            <a href="{{ route('barter.handover.show', $order->id) }}"
            class="barter-btn"
            style="text-align:center; text-decoration:none">

                Lihat Progres Barter

            </a>

        @else

            <p class="barter-note">
                Penawaran ini sudah ditutup.
            </p>

        @endif
    </section>
</div>
@endsection
