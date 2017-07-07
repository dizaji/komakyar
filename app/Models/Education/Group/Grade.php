<?php

namespace App\Models\Education\Group;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $table ='education_group_grades';

    public function dailyProgram()
    {
        return $this->belongsTo('App\Models\Education\Program\DailyProgram', 'daily_program_id', 'id');
    }

    public function groupStudent()
    {
        return $this->belongsTo('App\Models\Education\Group\GroupStudent', 'group_student_id', 'id');
    }

    public function gradeType()
    {
        return $this->belongsTo('App\Models\User\Teacher\GradeType', 'grade_type_id', 'id');
    }
}
