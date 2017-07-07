<?php

namespace App\Models\Education\Program;

use Illuminate\Database\Eloquent\Model;

class DailyProgram extends Model
{
    protected $table = "education_daily_programs";

    public function presentation()
    {
        return $this->belongsTo('App\Models\Education\Course\Presentation', 'presentation_id', 'id');
    }

    public function staff()
    {
        return $this->belongsTo('App\Models\User\Staff', 'staff_id', 'id');
    }

    public function group()
    {
        return $this->belongsTo('App\Models\Education\Group\Group', 'group_id', 'id');
    }

    public function rollcalls()
    {
        return $this->hasMany('App\Models\Education\Group\Rollcall', 'daily_program_id', 'id');
    }

    public function grades()
    {
        return $this->hasMany('App\Models\Education\Group\Grade', 'daily_program_id', 'id');
    }
}
