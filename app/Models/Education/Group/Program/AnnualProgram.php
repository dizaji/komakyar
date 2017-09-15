<?php

namespace App\Models\Education\Group\Program;

use Illuminate\Database\Eloquent\Model;

class AnnualProgram extends Model
{
    protected $table = 'education_annual_programs';

    public function groupPresentedCourse()
    {
        return $this->belongsTo('App\Models\Education\Group\GroupPresentedCourses', 'group_present_course_id', 'id');
    }
}
