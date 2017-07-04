<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $table = 'user_teachers';

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
