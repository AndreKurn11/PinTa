
@extends('layouts.seller')

@section('title', 'Kelola Produk')

@section('content')

<div class="page-title">
    <h1>Pengelolaan Produk</h1>
    <p>Kelola produk yang akan ditampilkan di marketplace PinTa.</p>
</div>

@if (session('success'))
    <div class="status status-active" style="margin-bottom:20px;">
        {{ session('success') }}
    </div>
@endif

{{-- INFORMASI TOKO --}}
<section class="card">
    <div class="card-heading">
        <div>
            <h2>{{ $store->store_name }}</h2>
            <p>Halaman pengelolaan produk milik tokomu.</p>
        </div>

        @if($store->status === 'active')
            <span class="status status-active">Toko Aktif</span>
        @else
            <span class="status status-inactive">
                {{ ucfirst($store->status) }}
            </span>
        @endif
    </div>

    <div class="store-details">
        <div class="detail-item">
            <div class="detail-label">Nama Toko</div>
            <div class="detail-value">{{ $store->store_name }}</div>
        </div>

        <div class="detail-item">
            <div class="detail-label">Status Toko</div>
            <div class="detail-value">
                {{ ucfirst($store->status) }}
            </div>
        </div>
    </div>
</section>


{{-- DAFTAR PRODUK --}}
<section class="card">

    <div class="card-heading">
        <div>
            <h2>Daftar Produk</h2>
            <p>
                Kelola seluruh produk yang kamu posting di PinTa.
            </p>
        </div>

        <a href="{{ route('seller.products.create') }}"
            class="btn">
                <span class="material-symbols-outlined"
                    style="font-size:17px">
                    add
                </span>
                Tambah Produk
            </a>
    </div>

    {{-- INFORMASI JUMLAH PRODUK --}}
    <div class="store-details">
        <div class="detail-item">
            <div class="detail-label">Total Produk</div>
            <div class="detail-value">
                {{ $listings->total() }} Produk
            </div>
        </div>
    </div>

    {{-- TABEL PRODUK --}}
    @if($listings->count() > 0)

        <div style="overflow-x:auto; margin-top:20px;">

            <table style="width:100%; border-collapse:collapse;">

                <thead>
                    <tr>
                        <th style="text-align:left; padding:12px;">
                            Produk
                        </th>

                        <th style="text-align:left; padding:12px;">
                            Kategori
                        </th>

                        <th style="text-align:left; padding:12px;">
                            Harga
                        </th>

                        <th style="text-align:left; padding:12px;">
                            Kondisi
                        </th>

                        <th style="text-align:left; padding:12px;">
                            Status
                        </th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($listings as $listing)

                        <tr style="border-top:1px solid #eee;">

                            {{-- GAMBAR DAN NAMA PRODUK --}}
                            <td style="padding:12px;">

                                <div style="display:flex; align-items:center; gap:12px;">

                                    @if($listing->primaryImage?->image_path)

                                        <img
                                            src="{{ \Illuminate\Support\Facades\Storage::url($listing->primaryImage->image_path) }}"
                                            alt="{{ $listing->title }}"
                                            style="width:65px; height:65px; object-fit:cover; border-radius:8px;"
                                        >

                                    @else

                                        <div style="width:65px; height:65px; background:#f3f0ec; border-radius:8px; display:flex; align-items:center; justify-content:center;">
                                            <span class="material-symbols-outlined">
                                                image
                                            </span>
                                        </div>

                                    @endif

                                    <div>
                                        <div style="font-weight:700;">
                                            {{ $listing->title }}
                                        </div>

                                        <small>
                                            {{ $listing->images->count() }}
                                            gambar
                                        </small>
                                    </div>

                                </div>

                            </td>

                            {{-- KATEGORI --}}
                            <td style="padding:12px;">
                                {{ $listing->category?->name ?? '-' }}
                            </td>

                            {{-- HARGA --}}
                            <td style="padding:12px;">
                                Rp {{ number_format((float) $listing->price, 0, ',', '.') }}
                            </td>

                            {{-- KONDISI --}}
                            <td style="padding:12px;">
                                {{ $listing->item_condition
                                    ? ucfirst(str_replace('_', ' ', $listing->item_condition))
                                    : '-' }}
                            </td>

                            {{-- STATUS --}}
                            <td style="padding:12px;">

                                <span class="status
                                    {{ $listing->status === 'active'
                                        ? 'status-active'
                                        : 'status-inactive' }}">

                                    {{ ucfirst($listing->status) }}

                                </span>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

        {{-- PAGINATION --}}
        <div style="margin-top:20px;">
            {{ $listings->links() }}
        </div>

    @else

        {{-- EMPTY STATE --}}
        <div class="empty-state">

            <span class="material-symbols-outlined">
                inventory_2
            </span>

            <div style="font-weight:800;color:#514a44">
                Belum ada data produk
            </div>

            <p>
                Kamu belum memiliki produk.
                Silakan tambahkan produk untuk mulai mengisi
                katalog toko PinTa.
            </p>

        </div>

    @endif

</section>

@endsection
