<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'districts';

    protected $fillable = ['name', 'region_id'];

    public function region()
    {
    	return $this->belongsTo('App\Models\Region', 'region_id');
    }

    public function markets()
    {
    	return $this->hasMany('App\Models\Market', 'district_id', 'region_id');
    }

    public function crops()
    {
    	return $this->belongsToMany('App\Models\Crop','crops_districts','district_id','crop_id');
    }
}
