<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
  protected $table = 'users';

  protected $fillable = [
    'name',
    'email',
    'password',
    'phone',
    'identity_number',
    'address',
    'avatar_path',
    'is_verified',
    'verified_at',
    'verified_by',
    'status',
  ];

  protected $hidden = [
    'password',
  ];

  protected function casts(): array
  {
    return [
      'password' => 'hashed',
      'is_verified' => 'boolean',
      'verified_at' => 'datetime',
    ];
  }

  /**
   * Relasi Many-to-Many dengan Role.
   */
  public function roles(): BelongsToMany
  {
    return $this->belongsToMany(
      Role::class,
      'users_roles',
      'user_id',
      'role_id'
    )->withPivot('assigned_at');
  }

  /**
   * Memeriksa apakah user memiliki role tertentu.
   */
  public function hasRole(string $role): bool
  {
    return $this->roles()
      ->where('name', $role)
      ->exists();
  }

  /**
   * Relasi One-to-One dengan Store.
   * Satu user maksimal memiliki satu toko.
   */
  public function store(): HasOne
  {
    return $this->hasOne(Store::class);
  }

  /**
   * Relasi One-to-Many dengan SellerRegistration.
   * Satu user dapat memiliki beberapa riwayat pengajuan penjual.
   */
  public function sellerRegistrations(): HasMany
  {
    return $this->hasMany(SellerRegistration::class);
  }

  /**
   * Relasi One-to-Many dengan Listing.
   * Satu user dapat memiliki banyak produk.
   */
  public function listings(): HasMany
  {
    return $this->hasMany(Listing::class, 'seller_id');
  }
}
