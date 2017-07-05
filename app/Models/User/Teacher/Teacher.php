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

    public function Presentations()
    {
        return $this->hasMany('App\Models\Education\Course\Presentation', 'teacher_id', 'id');
    }

    public function gradeTypes()
    {
        return $this->hasMany('App\Models\User\Teacher\GradeType', 'teacher_id', 'id');
    }
}
