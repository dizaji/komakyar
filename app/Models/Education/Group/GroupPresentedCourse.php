<?php

namespace App\Models\Education\Group;

use Illuminate\Database\Eloquent\Model;

class GroupPresentedCourse extends Model
{
    protected $table = 'education_group_presented_courses';

    public function presentation()
    {
        return $this->belongsTo('App\Models\Education\Course\Presentation', 'presentation_id', 'id');
    }

    public function group()
    {
        return $this->belongsTo('App\Models\Education\Group\Group', 'group_id', 'id');
    }

    public function annualProgram()
    {
        return $this->hasMany('App\Models\Education\Program\Group\AnnualProgram', 'group_present_course_id', 'id');
    }
}
