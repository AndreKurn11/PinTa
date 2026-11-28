<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BarterTransaction extends Model
{
    protected $fillable = ['order_id', 'inspection_status', 'inspection_note', 'inspected_by', 'inspected_at', 'seller_received_at', 'buyer_received_at'];

    protected function casts(): array
    {
        return ['inspected_at' => 'datetime', 'seller_received_at' => 'datetime', 'buyer_received_at' => 'datetime'];
    }

    public function order(): BelongsTo { return $this->belongsTo(Order::class); }
    public function inspector(): BelongsTo { return $this->belongsTo(User::class, 'inspected_by'); }
}
