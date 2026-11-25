<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
  protected $table = 'roles';

  protected $fillable = [
    'name',
    'description',
  ];

  // Relasi Many-to-Many dengan User
  public function users(): BelongsToMany
  {
    return $this->belongsToMany(
      User::class,
      'users_roles',
      'role_id',
      'user_id'
    )->withPivot('assigned_at');
  }
}
