<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'user_student';

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
