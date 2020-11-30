<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'noHp', 'alamat', 'username', 'id_role'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $dates = ['authenticated_at'];

    public function role()
    {
        return $this->belongsTo(Role::class, 'id_role');
    }

    public function hasRole($role)
    {
        return $this->role()->where('name', $role)->count() == 1;
    }

    public function artikel()
    {
        return $this->hasMany(Artikel::class, 'user_id');
    }

    public function getUptimeAttribute(): int
    {
        return Carbon::now()->diffInSeconds($this->getAttribute('authenticated_at'));
    }
}
