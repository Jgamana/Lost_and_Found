<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable([
    'name',
    'email',
    'password',
    'role',
    'status',
    'is_active',
])]
#[Hidden([
    'password',
    'remember_token',
])]
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'contact_number',
        'password',
        'role',
        'status',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    public function lostItems()
    {
        return $this->hasMany(LostItem::class);
    }

    public function foundItems()
    {
        return $this->hasMany(FoundItem::class);
    }

    public function receivedFoundItems()
    {
        return $this->hasMany(FoundItem::class, 'received_by');
    }

    public function claims()
    {
        return $this->hasMany(Claim::class, 'claimant_id');
    }

    public function verifiedClaims()
    {
        return $this->hasMany(Claim::class, 'verified_by');
    }

    public function finderCompensations()
    {
        return $this->hasMany(Compensation::class, 'finder_id');
    }

    public function claimantCompensations()
    {
        return $this->hasMany(Compensation::class, 'claimant_id');
    }

    public function confirmedCompensations()
    {
        return $this->hasMany(Compensation::class, 'confirmed_by');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
}