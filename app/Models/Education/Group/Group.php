<?php

namespace App\Models\Education\Group;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'education_groups';

    public function academicYear()
    {
        return $this->belongsTo('App\Models\AcademicYear', 'academic_year_id', 'id');
    }

    public function levelField()
    {
        return $this->belongsTo('App\Models\LevelField', 'level_field_id', 'id');
    }

    public function groupStudents()
    {
        return $this->hasMany('App\Models\Education\Group\GroupStudent', 'group_id', 'id');
    }

    public function students()
    {
        return $this->belongsToMany('App\Models\User\Student', 'education_group_students', 'group_id', 'student_id');
    }

    public function Presentation()
    {
        return $this->hasMany('App\Models\Education\Course\Presentation', 'group_id', 'id');
    }

    public function dailyPrograms()
    {
        return $this->hasMany('App\Models\Education\Program\DailyProgram', 'group_id', 'id');
    }

    public function annualPrograms()
    {
        return $this->hasMany('App\Models\Education\Program\AnnualProgram', 'group_id', 'id');
    }
}
