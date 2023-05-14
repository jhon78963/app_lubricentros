<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function userRoles()
    {
        return $this->hasMany(UserRole::class, 'role_id');
    }

    public function permissions()
    {
        return $this->hasMany(Permission::class, 'role_id');
    }
}
