<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BarterOffer extends Model
{
    protected $fillable = ['checkout_draft_id', 'listing_id', 'offerer_id', 'offer_type', 'cash_amount', 'price_difference', 'message', 'status', 'responded_at'];

    protected function casts(): array
    {
        return ['cash_amount' => 'decimal:2', 'price_difference' => 'decimal:2', 'responded_at' => 'datetime'];
    }

    public function listing(): BelongsTo
    {
        return $this->belongsTo(Listing::class)->withTrashed();
    }

    public function offerer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'offerer_id');
    }

    public function checkoutDraft(): BelongsTo
    {
        return $this->belongsTo(BarterCheckoutDraft::class, 'checkout_draft_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(BarterOfferItem::class, 'offer_id');
    }
}
