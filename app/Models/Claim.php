<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
    use HasFactory;

    protected $fillable = [
    'found_item_id',
    'claimant_id',
    'verified_by',
    'proof',
    'status',
    'release_date',
    'release_time',
    'release_location',
];

protected $casts = [
    'release_date' => 'date',
    'release_time' => 'datetime:H:i',
];

    public function foundItem()
    {
        return $this->belongsTo(FoundItem::class);
    }

    public function claimant()
    {
        return $this->belongsTo(User::class, 'claimant_id');
    }

    public function verifier()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    public function compensation()
    {
        return $this->hasOne(Compensation::class);
    }
}