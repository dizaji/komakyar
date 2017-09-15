<?php

namespace App\Models\User\RollCall;

use Illuminate\Database\Eloquent\Model;

class RollCallDeviceRecord extends Model
{
    protected $table = 'roll_call_devices';

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function rollCallDevice()
    {
        return $this->belongsTo('App\Models\User\RollCall\RollCallDevice', 'roll_call_device_id', 'id');
    }
}
