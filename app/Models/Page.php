<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $guarded = [];

    public static function getPageDetailsWithMedia($where= [])
    {
    	$query = self::select(
    		'pages.*',
    		'media_files.filename'
    	)
    		->leftJoin('media_files', 'media_files.id', 'pages.media_file_id')
    		->where($where)
    		->first();

    	return $query;
    }

	public function mediaFiles(){
		return $this->hasOne('App\Models\MediaFile','id','media_file_id');
	}
}
