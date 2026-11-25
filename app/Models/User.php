<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;
use App\Models\Role;

class User extends Authenticatable
{
  use Notifiable;

  protected $table = 'users';

  protected $fillable = [
    'name',
    'email',
    'password',
    'phone',
    'identity_number',
    'address',
    'avatar_path',
    'status',
  ];

  protected $hidden = [
    'password',
    'remember_token',
  ];

  protected function casts(): array
  {
    return [
      'password' => 'hashed',
      'is_verified' => 'boolean',
      'verified_at' => 'datetime',
    ];
  }

  // Relasi Many-to-Many dengan Role
  public function roles(): BelongsToMany
  {
    return $this->belongsToMany(
      Role::class,
      'users_roles',
      'user_id',
      'role_id'
    )->withPivot('assigned_at');
  }

  // Memeriksa apakah user memiliki role tertentu
  public function hasRole(string $role): bool
  {
    return $this->roles()
      ->where('name', $role)
      ->exists();
  }

  // Memeriksa apakah user memiliki salah satu role
  public function hasAnyRole(array $roles): bool
  {
    return $this->roles()
      ->whereIn('name', $roles)
      ->exists();
  }
}
