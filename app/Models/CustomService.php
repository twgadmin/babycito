<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomService extends Model
{
    use HasFactory,softDeletes;

    public function user(){
        return $this->belongsTo('App\Models\User','vendor_id');
    }

    public function category(){
        return $this->belongsTo('App\Models\Category','category_id');
    }

    public function registryUsers(){
        return $this->belongsToMany('App\Models\User','registries','services_id','user_id')->withPivot('status','created_at','updated_at');
    }

    public function categoryCustomService()
    {
        return $this->belongsToMany('App\Models\Category','category_custom_services','custom_service_id','category_id')->withPivot('category_id','custom_service_id','created_at','updated_at');
    }
}
