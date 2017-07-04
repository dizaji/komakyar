<?php

namespace App\Models\Education;

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
}
