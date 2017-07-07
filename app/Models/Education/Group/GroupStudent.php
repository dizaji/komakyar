<?php

namespace App\Models\Education\Group;

use Illuminate\Database\Eloquent\Model;

class GroupStudent extends Model
{
    protected $table = 'education_group_students';

    public function group()
    {
        return $this->belongsTo('App\Models\Education\Group\Group', 'group_id', 'id');
    }

    public function student()
    {
        return $this->belongsTo('App\Models\User\Student', 'student_id', 'id');
    }

    public function rollcalls()
    {
        return $this->hasMany('App\Models\Education\Group\Rollcall', 'group_student_id', 'id');
    }
}
