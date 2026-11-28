<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    protected $fillable = ['order_code', 'listing_id', 'buyer_id', 'seller_id', 'order_type', 'auction_id', 'barter_offer_id', 'item_amount', 'platform_fee_rate', 'platform_fee_amount', 'total_amount', 'seller_net_amount', 'payment_method', 'status', 'completed_at'];

    protected function casts(): array
    {
        return ['item_amount' => 'decimal:2', 'platform_fee_rate' => 'decimal:2', 'platform_fee_amount' => 'decimal:2', 'total_amount' => 'decimal:2', 'seller_net_amount' => 'decimal:2', 'completed_at' => 'datetime'];
    }

    public function listing(): BelongsTo { return $this->belongsTo(Listing::class)->withTrashed(); }
    public function buyer(): BelongsTo { return $this->belongsTo(User::class, 'buyer_id'); }
    public function seller(): BelongsTo { return $this->belongsTo(User::class, 'seller_id'); }
    public function barterOffer(): BelongsTo { return $this->belongsTo(BarterOffer::class); }
    public function barterTransaction(): HasOne { return $this->hasOne(BarterTransaction::class); }
}
