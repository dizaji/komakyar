<?php

namespace App\Models\Education\Group\Program;

use Illuminate\Database\Eloquent\Model;

class DailyProgram extends Model
{
    protected $table = "education_daily_programs";

    public function groupPresentedCourse()
    {
        return $this->belongsTo('App\Models\Education\Group\GroupPresentedCourse', 'group_present_course_id', 'id');
    }

    public function staff()
    {
        return $this->belongsTo('App\Models\User\Staff', 'staff_id', 'id');
    }

    public function rollCalls()
    {
        return $this->hasMany('App\Models\Education\Group\RollCall', 'daily_program_id', 'id');
    }

    public function grades()
    {
        return $this->hasMany('App\Models\Education\Group\Grade', 'daily_program_id', 'id');
    }
}
