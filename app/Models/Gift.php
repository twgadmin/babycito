<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gift extends Model
{

    protected $table = "gifts";
    
    protected $fillable = [
        'receiver_id',
        'email',
        'phone',
        'message',
        'giver',
        'items',
        'meta',
        'status',
        'amount'
    ];

    protected $casts =  [
        'meta' => 'array',
        'items' => 'array'
    ];


    /**
     * Get the comments for the blog post.
     */
    public function payment()
    {
        return $this->hasMany(RegistriesPayment::class,'gift_id');
    }
}
