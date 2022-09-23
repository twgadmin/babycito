<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeaturedImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'heading1',
        'heading2',
        'description',
        'media_image',
        'is_active'
    ];

    public static function getActiveFeaturedImage() 
    {
        $query = self::where('is_active', true)->first();
        return $query;
    }
}
