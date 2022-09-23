<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    public function serviceSection(){
        return $this->hasMany('App\Models\ServiceSection','service_id');
    }
}
