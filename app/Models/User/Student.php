<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'user_students';

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function parents()
    {
        return $this->hasMany('App\Models\User\StudentParent', 'student_id', 'id');
    }

    public function groupStudents()
    {
        return $this->hasMany('App\Models\Education\Group\GroupStudent', 'student_id', 'id');
    }
}
