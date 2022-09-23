<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'designation',
        'content',
        'media_image',
        'is_featured'
    ];

    public static function getAllTestimonials()
    {
        $query = self::where("is_featured", 1)->get();
        return $query;
    }
}
