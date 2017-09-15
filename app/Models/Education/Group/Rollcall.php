<?php

namespace App\Models\Education\Group;

use Illuminate\Database\Eloquent\Model;

class RollCall extends Model
{
    protected $table = 'education_group_rollcalls';

    public function dailyProgram()
    {
        return $this->belongsTo('App\Models\Education\Group\Program\DailyProgram', 'daily_program_id', 'id');
    }

    public function groupStudent()
    {
        return $this->belongsTo('App\Models\Education\Group\GroupStudent', 'group_student_id', 'id');
    }
}
