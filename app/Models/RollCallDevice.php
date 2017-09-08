<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RollCallDevice extends Model
{
    //
    protected $table = 'rollcall_devices';

    public function user(){
//
        return $this->belongsTo('App\User', 'user_id','id');
    }
}
