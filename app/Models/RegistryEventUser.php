<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistryEventUser extends Model
{
    protected $table = "registry_event_user";

    protected $fillable = ['registry_event_id',"event_date",'user_id'];

   
     public function registry_event(){
        return $this->belongsTo('App\Models\RegistryEvent');
    }
}
