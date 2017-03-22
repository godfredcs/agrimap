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
        'role_id', 'username', 'name', 'email', 'password',
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
     * Determines if a user is a system admin
     * 
     * @return boolean
     */
    public function isSystemAdmin() 
    {
        $user = self::with('role')->find($this->id);

        return strtolower($user->role->system_name) === 'sys_admin';
    }

    /**
     * Determines if a user is a site administrator
     * 
     * @return boolean
     */
    public function isSiteAdmin() 
    {
        $user = self::with('role')->find($this->id);

        return strtolower($user->role->system_name) === 'admin';
    }
}
