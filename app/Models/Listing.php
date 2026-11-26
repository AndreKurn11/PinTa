<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Listing extends Model
{
    use SoftDeletes;

    /**
     * Nama tabel yang digunakan.
     */
    protected $table = 'listings';

    /**
     * Atribut yang boleh diisi secara mass assignment.
     */
    protected $fillable = [
        'seller_id',
        'category_id',
        'title',
        'description',
        'item_condition',
        'location',
        'sale_mode',
        'price',
        'status',
    ];

    /**
     * Casting tipe data.
     */
    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'deleted_at' => 'datetime',
        ];
    }

    /**
     * Relasi ke user (seller).
     */
    public function seller(): BelongsTo
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    /**
     * Relasi ke kategori.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * Relasi ke gambar listing.
     */
    public function images(): HasMany
    {
        return $this->hasMany(ListingImage::class, 'listing_id')
            ->orderBy('sort_order');
    }

    /**
     * Relasi ke gambar utama listing.
     */
    public function primaryImage(): HasOne
    {
        return $this->hasOne(ListingImage::class, 'listing_id')
            ->where('is_primary', true);
    }

    /**
     * Scope untuk listing aktif.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope untuk listing milik seller tertentu.
     */
    public function scopeOwnedBy($query, $sellerId)
    {
        return $query->where('seller_id', $sellerId);
    }
}
