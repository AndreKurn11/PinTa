@php
    $offer = $order->barterOffer;
    $transaction = $order->barterTransaction;
    $draft = $offer->checkoutDraft;
    $isBuyer = (int) auth()->id() === (int) $order->buyer_id;
    $side = $isBuyer ? 'buyer' : 'seller';
    $other = $isBuyer ? 'seller' : 'buyer';
    $cashOnly = $offer->offer_type === 'cash';
    $shipping = $draft->delivery_method === 'shipping';
    $canAct = $paymentReady && $transaction->inspection_status !== 'failed' && $offer->status === 'accepted';
    $back = $isBuyer ? route('barter.offers.show', $offer->id) : route('seller.barter.show', $offer->id);
@endphp
<div class="handover-title">
    <a href="{{ $back }}">← Kembali ke Detail Penawaran</a>
    <h1>Serah Terima Barter</h1>
    <p>{{ $order->order_code }} · {{ $shipping ? 'Pengiriman manual' : 'Bertemu langsung / COD' }}</p>
</div>
@if(session('success'))<div class="handover-info" role="status">{{ session('success') }}</div>@endif
@if($errors->any())<div class="handover-error" role="alert">{{ $errors->first() }}</div>@endif
<div class="handover-grid">
    <div>
        <section class="handover-card">
            <div class="handover-heading"><h2>Barang yang Dipertukarkan</h2><span class="handover-badge">{{ $order->status === 'completed' ? 'Selesai' : ($canAct ? 'Serah terima' : $order->status) }}</span></div>
            <div class="handover-row"><div><small>Barang penjual</small><h3>{{ $order->listing->title }}</h3><p>{{ $order->seller->name }}</p></div><span class="material-symbols-outlined">inventory_2</span></div>
            @forelse($offer->items as $item)
                <div class="handover-row"><div><small>Barang pembeli</small><h3>{{ $item->item_name }}</h3><p>{{ $order->buyer->name }}</p></div><span class="material-symbols-outlined">swap_horiz</span></div>
            @empty
                <div class="handover-row"><p>Penawaran tunai — tidak ada barang dari pembeli.</p></div>
            @endforelse
        </section>
        <section class="handover-card">
            <h2>Progres Serah Terima</h2>
            @if($shipping)
                <div class="handover-row"><div><h3>Pengiriman dari penjual</h3><p>{{ $transaction->seller_sent_at ?: 'Belum dicatat' }}</p><p>Resi: {{ $transaction->seller_tracking_number ?: '—' }}</p></div><span class="handover-badge">{{ $transaction->seller_sent_at ? 'Dikirim' : 'Menunggu' }}</span></div>
                @unless($cashOnly)
                    <div class="handover-row"><div><h3>Pengiriman dari pembeli</h3><p>{{ $transaction->buyer_sent_at ?: 'Belum dicatat' }}</p><p>Resi: {{ $transaction->buyer_tracking_number ?: '—' }}</p></div><span class="handover-badge">{{ $transaction->buyer_sent_at ? 'Dikirim' : 'Menunggu' }}</span></div>
                @endunless
            @endif
            <div class="handover-row"><div><h3>Pembeli menerima barang</h3><p>{{ $transaction->buyer_received_at ?: 'Belum dikonfirmasi' }}</p></div><span class="handover-badge">{{ $transaction->buyer_received_at ? 'Diterima' : 'Menunggu' }}</span></div>
            @unless($cashOnly)
                <div class="handover-row"><div><h3>Penjual menerima barang</h3><p>{{ $transaction->seller_received_at ?: 'Belum dikonfirmasi' }}</p></div><span class="handover-badge">{{ $transaction->seller_received_at ? 'Diterima' : 'Menunggu' }}</span></div>
            @endunless
        </section>
        <section class="handover-card">
            <h2>Informasi Serah Terima</h2>
            <p>{{ $shipping ? 'Alamat pembeli dari checkout' : 'Titik temu yang diajukan' }}: {{ $draft->delivery_address }}</p>
            @if($shipping)<p>Alamat penjual saat ini: {{ $order->seller->address ?: 'Belum tersedia — sepakati dengan penjual' }}</p>@endif
            <p>{{ $draft->notes ?: 'Tidak ada catatan checkout.' }}</p>
            <p>Untuk pengiriman, sepakati alamat dan kurir sebelum mengirim. Resi dicatat manual, bukan pelacakan real-time.</p>
        </section>
    </div>
    <aside class="handover-card">
        <h2>Ringkasan Kesepakatan</h2>
        <div class="handover-row"><span>Tambahan uang / tunai</span><strong>Rp {{ number_format($order->item_amount, 0, ',', '.') }}</strong></div>
        <div class="handover-row"><span>Fee platform</span><strong>Rp {{ number_format($order->platform_fee_amount, 0, ',', '.') }}</strong></div>
        <div class="handover-row"><span>Total kewajiban</span><strong>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</strong></div>
        @if($order->status === 'completed')
            <div class="handover-info"><strong>Barter selesai</strong><p>Konfirmasi yang diperlukan telah lengkap. Barang tidak tersedia untuk transaksi baru.</p><p>{{ $order->completed_at }}</p></div>
        @elseif(!$canAct)
            <div class="handover-info">{{ $transaction->inspection_status === 'failed' ? 'Pemeriksaan gagal. Hubungi admin.' : 'Serah terima belum dapat diproses. Pastikan kewajiban pembayaran telah diverifikasi dan order masih berlaku.' }}</div>
        @else
            <div class="handover-info">{{ $order->total_amount === '0.00' ? 'Tidak ada kewajiban pembayaran.' : 'Status order memungkinkan serah terima.' }} Konfirmasi hanya jika barang benar-benar telah dikirim atau diterima.</div>
            @if($shipping && (!$cashOnly || !$isBuyer) && !$transaction->{$side.'_sent_at'})
                <form method="POST" action="{{ route('barter.handover.send', $order->id) }}">
                    @csrf
                    <label for="tracking_number">Nomor resi pengiriman Anda</label>
                    <input id="tracking_number" name="tracking_number" value="{{ old('tracking_number') }}" maxlength="100" required>
                    <label class="handover-agree"><input type="checkbox" name="agreement" value="1" required> Saya sudah mengirim barang.</label>
                    <button class="handover-btn" type="submit">Catat Pengiriman</button>
                </form>
            @endif
            @if((!$cashOnly || $isBuyer) && !$transaction->{$side.'_received_at'} && (!$shipping || $transaction->{$other.'_sent_at'}))
                <form method="POST" action="{{ route('barter.handover.receive', $order->id) }}" onsubmit="return confirm('Konfirmasi barang sudah diterima?')">
                    @csrf
                    <label class="handover-agree"><input type="checkbox" name="agreement" value="1" required> Saya sudah menerima barang dan menyetujui kondisinya.</label>
                    <button class="handover-btn" type="submit">Konfirmasi Barang Diterima</button>
                </form>
            @elseif($transaction->{$side.'_received_at'})
                <p class="handover-info">Penerimaan Anda sudah tercatat. Menunggu proses yang masih diperlukan.</p>
            @endif
        @endif
    </aside>
</div>
