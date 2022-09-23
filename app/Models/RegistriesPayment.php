<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistriesPayment extends Model
{

    protected $table = "registries_payment";
    
    protected $fillable = [
        'gift_id',
        'user_id',
        'price',
        'registry_service_id',
    ];


    /**
     * Get the post that owns the comment.
     */
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    /**
     * Get the post that owns the comment.
     */
    public function service()
    {
        return $this->belongsTo(CustomService::class,'registry_service_id');
    }

}
