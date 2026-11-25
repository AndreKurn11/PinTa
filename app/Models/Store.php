<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Store extends Model
{
    protected $table = 'stores';

    protected $fillable = [
        'user_id',
        'store_name',
        'slug',
        'description',
        'phone',
        'address',
        'logo_path',
        'status',
    ];

    /**
     * Relasi Many-to-One dengan User.
     * Setiap toko dimiliki oleh satu user.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
