<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LostItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'custom_category',
        'location_id',
        'custom_location',
        'item_name',
        'description',
        'compensation_offer',
        'image',
        'lost_date',
        'status',
    ];

    protected $casts = [
        'compensation_offer' => 'decimal:2',
        'lost_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}