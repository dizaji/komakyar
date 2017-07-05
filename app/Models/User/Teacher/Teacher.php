<?php

namespace App\Models\User\Teacher;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $table = 'user_teachers';

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function Presentation()
    {
        return $this->hasMany('App\Models\Education\Course\Presentation', 'teacher_id', 'id');
    }
}
