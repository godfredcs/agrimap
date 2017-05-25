<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table = 'regions';

    protected $guarded = [];

    /**
     * Declare relationship between regions and districts
     * @return [type] [description]
     */
    public function districts()
    {
    	return $this->hasMany(District::class, 'region_id');
    }

    public function crops()
    {
        return $this->hasMany(Crop::class);
    }
}
