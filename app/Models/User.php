<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, TwoFactorAuthenticatable, HasProfilePhoto;

    protected $guarded = [];

    protected $hidden = [
        // 'password',
        'remember_token',
        'email_verified_at',
        'provider_id',
        'provider',
        'is_active',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at'        => 'datetime',
        'updated_at'        => 'datetime',
        'is_active'         => 'boolean',
        'password'          => 'hashed',
        'id'                => 'integer',
        'is_premium'        => 'boolean',
        'term_accept'       => 'boolean',
        'deleted_at'        => 'datetime',
        'metadata'          => 'array',
    ];

    // Scopes
    public function scopeVerified($q)
    {
        return $q->whereNotNull('email_verified_at');
    }
    public function scopeActive($q)
    {
        return $q->where('is_active', true);
    }
    public function scopeUser($q)
    {
        return $q->where('role', 'user');
    }
    public function scopeTeam($q)
    {
        return $q->where('role', 'team');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

}
