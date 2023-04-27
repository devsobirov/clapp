<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'is_admin'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin(): bool
    {
        return $this->isSuperAdmin() || !!$this->is_admin;
    }

    public function isSuperAdmin(): bool
    {
        return !!$this->is_super_admin;
    }

    public function getRole(): string
    {
        if ($this->isSuperAdmin()) return 'Super Admin';
        if ($this->isAdmin()) return 'Admin';
        return '-';
    }

    public function avatar_url(): string
    {
        return asset($this->avatar ?? 'images/no-img-avatar.png');
    }
}
