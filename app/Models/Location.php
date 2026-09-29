<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];


     public function lostItems()
        {
            return $this->hasMany(LostItem::class);
        }

    public function foundItems()
        {
            return $this->hasMany(FoundItem::class);
        }
}