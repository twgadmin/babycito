<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Registry extends Model
{
    use HasFactory,softDeletes;


    public function custom_service(){
         return $this->hasOne('App\Models\CustomService','id','services_id');
    }


     public function payments(){
         return $this->hasMany('App\Models\RegistriesPayment','id','registry_service_id');
    }
    
}
