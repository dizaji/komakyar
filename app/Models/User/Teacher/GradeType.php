<?php

namespace App\Models\User\Teacher;

use Illuminate\Database\Eloquent\Model;

class GradeType extends Model
{
    protected $table = 'user_teacher_grade_types';

    public function teacher()
    {
        return $this->belongsTo('App\Models\User\Teacher\Teacher', 'teacher_id', 'id');
    }

    public function courseSource()
    {
        return $this->belongsTo('App\Models\Lookup\CourseSource', 'course_source_id', 'id');
    }

    public function grades()
    {
        return $this->hasMany('App\Models\Education\Group\Grade', 'grade_type_id', 'id');
    }
}
