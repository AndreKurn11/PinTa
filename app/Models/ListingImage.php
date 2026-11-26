<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ListingImage extends Model
{
    /**
     * Nama tabel yang digunakan.
     */
    protected $table = 'listing_images';

    /**
     * Tabel tidak memiliki kolom updated_at.
     */
    public const UPDATED_AT = null;

    /**
     * Atribut yang boleh diisi secara mass assignment.
     */
    protected $fillable = [
        'listing_id',
        'image_path',
        'is_primary',
        'sort_order',
    ];

    /**
     * Casting tipe data.
     */
    protected function casts(): array
    {
        return [
            'is_primary' => 'boolean',
            'sort_order' => 'integer',
            'created_at' => 'datetime',
        ];
    }

    /**
     * Relasi ke listing pemilik foto.
     */
    public function listing(): BelongsTo
    {
        return $this->belongsTo(Listing::class, 'listing_id');
    }

    /**
     * Scope untuk mengambil foto utama.
     */
    public function scopePrimary($query)
    {
        return $query->where('is_primary', true);
    }
}
