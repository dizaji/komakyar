<?php

namespace App\Models\Education\Course;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'education_courses';

    public function courseSource()
    {
        return $this->belongsTo('App\Models\Lookup\CourseSource', 'course_source_id', 'id');
    }

    public function levelField()
    {
        $this->belongsTo('App\Models\LevelField', 'level_field_id', 'id');
    }

    public function academicYear()
    {
        $this->belongsTo('App\Models\AcademicYear', 'academic_year_id', 'id');
    }

    public function Presentations()
    {
        return $this->hasMany('App\Models\Education\Course\Presentation', 'course_id', 'id');
    }
}
