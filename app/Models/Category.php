<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    /**
     * Nama tabel yang digunakan.
     */
    protected $table = 'categories';

    /**
     * Atribut yang boleh diisi secara mass assignment.
     */
    protected $fillable = [
        'parent_id',
        'name',
        'slug',
    ];

    /**
     * Relasi ke kategori induk (Parent).
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /**
     * Relasi ke kategori anak (Children).
     */
    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    /**
     * Relasi ke listing yang menggunakan kategori ini.
     */
    public function listings(): HasMany
    {
        return $this->hasMany(Listing::class, 'category_id');
    }
}
