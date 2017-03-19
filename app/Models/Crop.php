<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Crop extends Model
{
    protected $table = 'crops';

    protected $fillable = ['name', 'description'];

    public function districts()
    {
    	return $this->belongsToMany('App\Models\District', 'crops_districts', 'crop_id','district_id');
    }
}
