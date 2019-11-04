<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use HasRoles;
    use Notifiable;

    protected $fillable = [
        'username', 'password', 'nickname', 'avatar', 'token', 'last_login', 'status'
    ];

    protected $casts = [
        'status' => 'boolean',
        'last_login' => 'datetime',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function verifyPassword(string $password): bool
    {
        return Hash::check($password, $this->password);
    }

    public function materials()
    {
        return $this->hasMany(Material::class);
    }

    public function materialsLog()
    {
        return $this->hasMany(MaterialsLog::class);
    }
}
