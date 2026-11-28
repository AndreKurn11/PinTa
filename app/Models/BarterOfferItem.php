<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BarterOfferItem extends Model
{
    public const UPDATED_AT = null;
    protected $fillable = ['offer_id', 'offered_listing_id', 'item_name', 'description', 'item_condition', 'estimated_value', 'image_path'];

    protected function casts(): array
    {
        return ['estimated_value' => 'decimal:2'];
    }

    public function offer(): BelongsTo
    {
        return $this->belongsTo(BarterOffer::class, 'offer_id');
    }

    public function offeredListing(): BelongsTo
    {
        return $this->belongsTo(Listing::class, 'offered_listing_id')->withTrashed();
    }
}
