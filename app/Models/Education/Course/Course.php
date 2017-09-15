<?php

namespace App\Models\Education\Course;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'education_courses';

    public function presentations()
    {
        return $this->hasMany('App\Models\Education\Course\Presentation', 'course_id', 'id');
    }

    public function gradeTypes()
    {
        return $this->hasMany('App\Models\User\Teacher\GradeType', 'course_id', 'id');
    }
}
