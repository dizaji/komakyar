<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function student()
    {
        return $this->hasOne('App\Models\User\Student', 'user_id', 'id');
    }

    public function parent()
    {
        return $this->hasOne('App\Models\User\StudentParent', 'user_id', 'id');
    }

    public function staff()
    {
        return $this->hasOne('App\Models\User\Staff', 'user_id', 'id');
    }

    public function teacher()
    {
        return $this->hasOne('App\Models\User\Teacher\Teacher', 'user_id', 'id');
    }

    public function rollCallDevices()
    {
        return $this->belongsToMany('App\Models\User\RollCall\RollCallDevice', 'roll_call_device_user_id', 'user_id', 'roll_call_device_id')
            ->withPivot('device_user_id');
    }

    public function rollCallDeviceRecords()
    {
        return $this->hasMany('App\Models\User\RollCall\RollCallDeviceRecord', 'user_id', 'id');
    }
}
