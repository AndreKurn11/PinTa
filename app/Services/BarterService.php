<?php

namespace App\Services;

use App\Models\AuditLog;
use App\Models\BarterOffer;
use App\Models\Listing;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BarterService
{
    public function decide(int $offerId, int $sellerId, bool $accept): ?Order
    {
        // Baca referensi sebelum transaksi, lalu validasi ulang dengan row lock.
        $initial = BarterOffer::with('items')->findOrFail($offerId);
        $ids = $initial->items->pluck('offered_listing_id')->filter()->push($initial->listing_id)->unique()->values();

        return DB::transaction(function () use ($initial, $ids, $sellerId, $accept) {
            // Urutan penguncian: users -> listings -> offers.
            $users = User::whereIn('id', [$sellerId, $initial->offerer_id])->orderBy('id')->lockForUpdate()->get()->keyBy('id');
            $seller = $users->get($sellerId);
            abort_unless($seller && $seller->status === 'active' && $seller->hasRole('penjual'), 403);
            $listings = Listing::withTrashed()->whereIn('id', $ids)->orderBy('id')->lockForUpdate()->get()->keyBy('id');
            $target = $listings->get($initial->listing_id);
            abort_unless($target && (int) $target->seller_id === $sellerId, 404);
            $offer = BarterOffer::whereKey($initial->id)->lockForUpdate()->firstOrFail();
            if ($accept && $offer->status === 'accepted') {
                return Order::where('barter_offer_id', $offer->id)->firstOrFail();
            }
            abort_unless($offer->status === 'pending', 409, 'Penawaran sudah diproses.');
            if (!$accept) {
                $this->changeOffer($offer, 'rejected', $sellerId);
                return null;
            }

            abort_unless(!$target->trashed() && $target->status === 'active' && $target->sale_mode === 'barter', 409, 'Produk tidak tersedia.');
            $buyer = $users->get($offer->offerer_id);
            abort_unless($buyer && $buyer->status === 'active' && $buyer->hasRole('pembeli') && (int) $buyer->id !== $sellerId, 409, 'Akun pembeli tidak memenuhi syarat.');
            $items = $offer->items()->get();
            abort_unless(($offer->offer_type === 'cash' && $items->isEmpty() && $offer->cash_amount > 0) || ($offer->offer_type === 'item' && $items->isNotEmpty() && $offer->cash_amount == 0) || ($offer->offer_type === 'mixed' && $items->isNotEmpty() && $offer->cash_amount > 0), 409, 'Isi penawaran tidak konsisten.');
            foreach ($items as $item) {
                if (!$item->offered_listing_id) continue;
                $owned = $listings->get($item->offered_listing_id);
                abort_unless($owned && !$owned->trashed() && (int) $owned->seller_id === (int) $buyer->id && $owned->status === 'active' && $owned->sale_mode !== 'auction', 409, 'Barang tawaran tidak lagi tersedia.');
                abort_unless($owned->title === $item->item_name && $owned->description === $item->description && $owned->item_condition === $item->item_condition && $owned->price === $item->estimated_value, 409, 'Barang tawaran berubah. Minta pembeli mengajukan ulang.');
            }

            // Nominal final mengikuti tawaran pembeli, tidak boleh diubah sepihak.
            // Fee 0 adalah kebijakan demo sementara; tahap 5 wajib menyepakati tarif sebelum transaksi baru.
            $amount = $offer->cash_amount;
            $order = Order::create([
                'order_code' => 'PNT-'.Str::upper((string) Str::ulid()),
                'listing_id' => $target->id, 'buyer_id' => $buyer->id, 'seller_id' => $sellerId,
                'order_type' => 'barter', 'barter_offer_id' => $offer->id,
                'item_amount' => $amount, 'platform_fee_rate' => 0, 'platform_fee_amount' => 0,
                'total_amount' => $amount, 'seller_net_amount' => $amount,
                'status' => 'awaiting_payment',
            ]);
            $transaction = $order->barterTransaction()->create(['inspection_status' => 'waiting']);
            $offer->price_difference = $amount;
            $this->changeOffer($offer, 'accepted', $sellerId);
            foreach ($listings as $listing) {
                $listing->update(['status' => 'in_transaction']);
                $this->audit($sellerId, 'status_change', 'listings', $listing->id, ['status' => 'active'], ['status' => 'in_transaction']);
            }
            // Tutup tawaran lain yang menggunakan salah satu listing yang baru direservasi.
            $conflicts = BarterOffer::where('status', 'pending')->where('id', '!=', $offer->id)
                ->where(function ($query) use ($ids) {
                    $query->whereIn('listing_id', $ids)->orWhereHas('items', fn ($q) => $q->whereIn('offered_listing_id', $ids));
                })->orderBy('id')->lockForUpdate()->get();
            foreach ($conflicts as $conflict) {
                $this->changeOffer($conflict, 'expired', $sellerId);
            }
            $this->audit($sellerId, 'create', 'orders', $order->id, null, ['status' => $order->status, 'barter_offer_id' => $offer->id, 'total_amount' => $amount]);
            $this->audit($sellerId, 'create', 'barter_transactions', $transaction->id, null, ['order_id' => $order->id, 'inspection_status' => 'waiting']);
            return $order;
        }, 3);
    }

    private function changeOffer(BarterOffer $offer, string $status, int $actor): void
    {
        $old = $offer->getOriginal('status');
        $offer->status = $status;
        $offer->responded_at = now();
        $offer->save();
        $this->audit($actor, 'status_change', 'barter_offers', $offer->id, ['status' => $old], ['status' => $status, 'price_difference' => $offer->price_difference]);
    }

    private function audit(int $actor, string $action, string $table, int $id, ?array $old, array $new): void
    {
        AuditLog::create(['user_id' => $actor, 'action' => $action, 'table_name' => $table, 'record_id' => $id, 'old_values' => $old, 'new_values' => $new]);
    }
}
