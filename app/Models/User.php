<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id', 'status_id', 'username', 'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Username should be in lower case
     * 
     * @param string $value
     */
    public function setUsernameAttribute($value)
    {
        $this->attributes['username'] = strtolower($value);
    }

    /**
     * Name should be in title (pascal) case
     * 
     * @param string $value
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = title_case($value);
    }

    /**
     * Email should be in title (pascal) case
     * 
     * @param string $value
     */
    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtolower($value);
    }

    /**
     * Declares relationship that a user has one role
     * 
     * @return Illuminate\Database\Eloquent
     */
    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }

    /**
     * Declares relationship between user and products added by that user
     * 
     * @return Illuminate\Database\Eloquent
     */
    public function products()
    {
        return $this->hasMany('App\Models\Product', 'added_by');
    }

    /**
     * Declares relationship that a user has one status
     * 
     * @return Illuminate\Database\Eloquent
     */
    public function status()
    {
        return $this->belongsTo('App\Models\UserStatus');
    }

    /**
     * Determines if a user is a manager
     * 
     * @return boolean
     */
    public function isManager() 
    {
        $user = self::with('role')->find($this->id);

        return strtolower($user->role->name) === 'manager';
    }

    /**
     * Determines if a user is a pharmacist
     * 
     * @return boolean
     */
    public function isPharmacist() 
    {
        $user = self::with('role')->find($this->id);

        return strtolower($user->role->name) === 'pharmacist';
    }

    /**
     * Determines if a user is a cashier
     * 
     * @return boolean
     */
    public function isCashier() 
    {
        $user = self::with('role')->find($this->id);

        return strtolower($user->role->name) === 'cashier';
    }

    /**
     * Determines if a user is active
     * 
     * @return boolean
     */
    public function isActivated()
    {
        $user = self::with('status')->find($this->id);

        return strtolower($user->status->name) === 'active';
    }
}
