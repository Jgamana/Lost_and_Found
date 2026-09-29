<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompensationRule extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'min_amount',
        'max_amount',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}