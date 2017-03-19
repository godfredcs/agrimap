<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Market extends Model
{
    protected $table = 'markets';

    public function district()
    {
    	return $this->belongsTo('App\Models\District', 'district_id');
    }
}
