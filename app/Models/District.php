<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'districts';

    public function region()
    {
    	return $this->belongsTo('App\Models\Region', 'district_id', 'region_id');
    }

    public function markets()
    {
    	return $this->hasMany('App\Models\Market', 'district_id');
    }

    public function crops()
    {
    	return $this->belongsToMany('App\Models\Crop','crops_districts','district_id','crop_id');
    }
}
