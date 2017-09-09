<?php

namespace App\Models\User\RollCall;

use Illuminate\Database\Eloquent\Model;

class RollCallDevice extends Model
{
    protected $table = 'roll_call_devices';

    public function users()
    {
        return $this->belongsToMany('App\User', 'roll_call_device_user_id', 'roll_call_device_id', 'user_id')
            ->withPivot('device_user_id');
    }

    public function records()
    {
        return $this->hasMany('App\Models\User\RollCall\RollCallDeviceRecord', 'roll_call_device_id', 'id');
    }
}
