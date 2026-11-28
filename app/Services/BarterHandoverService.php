<?php

namespace App\Services;

use App\Models\AuditLog;
use App\Models\BarterOffer;
use App\Models\Listing;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class BarterHandoverService
{
    // Pembayaran hanya dibaca. Modul pembayaran bertanggung jawab atas verifikasi.
    public function paymentReady(Order $order): bool
    {
        return in_array($order->status, ['paid', 'shipped', 'delivered'], true)
            || ($order->status === 'awaiting_payment' && $order->total_amount === '0.00');
    }

    public function cancelPending(int $offerId, int $actor): void
    {
        DB::transaction(function () use ($offerId, $actor) {
            $user = User::whereKey($actor)->lockForUpdate()->firstOrFail();
            abort_unless($user->status === 'active' && $user->hasRole('pembeli'), 403);
            $offer = BarterOffer::where('offerer_id', $actor)->lockForUpdate()->findOrFail($offerId);
            if ($offer->status === 'cancelled') return;
            abort_unless($offer->status === 'pending', 409, 'Hanya penawaran pending yang dapat dibatalkan.');
            $offer->update(['status' => 'cancelled']);
            $this->audit($actor, 'barter_offers', $offer->id, ['status' => 'pending'], ['status' => 'cancelled']);
        }, 3);
    }

    public function handover(int $orderId, int $actor, string $action, ?string $tracking = null): void
    {
        $initial = Order::where('order_type', 'barter')->where(fn ($q) => $q->where('buyer_id', $actor)->orWhere('seller_id', $actor))->findOrFail($orderId);
        $initialOffer = BarterOffer::with('items')->findOrFail($initial->barter_offer_id);
        $ids = $initialOffer->items->pluck('offered_listing_id')->filter()->push($initial->listing_id)->unique()->values();
        DB::transaction(function () use ($initial, $initialOffer, $ids, $actor, $action, $tracking) {
            // Ikuti urutan lock tahap 4: users -> listings -> offers -> orders -> barter_transactions.
            $user = User::whereKey($actor)->lockForUpdate()->firstOrFail();
            abort_unless($user->status === 'active', 403);
            $listings = Listing::withTrashed()->whereIn('id', $ids)->orderBy('id')->lockForUpdate()->get()->keyBy('id');
            $offer = BarterOffer::whereKey($initialOffer->id)->lockForUpdate()->firstOrFail();
            $order = Order::where('order_type', 'barter')->lockForUpdate()->findOrFail($initial->id);
            $isBuyer = (int) $order->buyer_id === $actor;
            abort_unless(($isBuyer && $user->hasRole('pembeli')) || ((int) $order->seller_id === $actor && $user->hasRole('penjual')), 403);
            abort_unless((int) $order->barter_offer_id === (int) $offer->id && $offer->status === 'accepted', 409);
            $transaction = $order->barterTransaction()->lockForUpdate()->firstOrFail();
            if ($order->status === 'completed') return;
            abort_unless($this->paymentReady($order), 409, 'Pembayaran belum terverifikasi atau order tidak dapat diproses.');
            abort_if($transaction->inspection_status === 'failed', 409, 'Pemeriksaan barang gagal. Hubungi admin.');
            $draft = $offer->checkoutDraft;
            abort_unless($draft && in_array($draft->delivery_method, ['cod', 'shipping'], true), 409);
            $cashOnly = $offer->offer_type === 'cash';
            $side = $isBuyer ? 'buyer' : 'seller';
            $other = $isBuyer ? 'seller' : 'buyer';
            if ($action === 'send') {
                abort_unless($draft->delivery_method === 'shipping' && (!$cashOnly || !$isBuyer) && $tracking, 409);
                $field = $side.'_sent_at';
                if ($transaction->$field !== null) return;
                $transaction->$field = now();
                $transaction->{$side.'_tracking_number'} = $tracking;
                $transaction->save();
                $this->audit($actor, 'barter_transactions', $transaction->id, [$field => null], [$field => (string) $transaction->$field]);
                return;
            }
            abort_unless($action === 'receive' && (!$cashOnly || $isBuyer), 409);
            $field = $side.'_received_at';
            if ($transaction->$field !== null) return;
            if ($draft->delivery_method === 'shipping') {
                abort_unless($transaction->{$other.'_sent_at'} !== null, 409, 'Pengirim belum mencatat pengiriman.');
            }
            $transaction->$field = now();
            $transaction->save();
            $this->audit($actor, 'barter_transactions', $transaction->id, [$field => null], [$field => (string) $transaction->$field]);
            if (!$transaction->buyer_received_at || (!$cashOnly && !$transaction->seller_received_at)) return;

            // Barang yang direservasi tidak boleh sudah dipakai transaksi lain.
            abort_unless($listings->count() === $ids->count(), 409);
            foreach ($listings as $listing) {
                abort_unless(!$listing->trashed() && $listing->status === 'in_transaction', 409, 'Reservasi barang tidak konsisten. Hubungi admin.');
                $expectedOwner = (int) $listing->id === (int) $order->listing_id ? $order->seller_id : $order->buyer_id;
                abort_unless((int) $listing->seller_id === (int) $expectedOwner, 409);
                $listing->update(['status' => 'sold']);
                $this->audit($actor, 'listings', $listing->id, ['status' => 'in_transaction'], ['status' => 'sold']);
            }
            $old = $order->status;
            $order->update(['status' => 'completed', 'completed_at' => now()]);
            $this->audit($actor, 'orders', $order->id, ['status' => $old], ['status' => 'completed']);
        }, 3);
    }

    private function audit(int $actor, string $table, int $id, array $old, array $new): void
    {
        AuditLog::create(['user_id' => $actor, 'action' => 'status_change', 'table_name' => $table, 'record_id' => $id, 'old_values' => $old, 'new_values' => $new]);
    }
}
