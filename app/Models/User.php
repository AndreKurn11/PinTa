<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
}
