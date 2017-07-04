<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    protected $table = 'academic_years';

    public function groups()
    {
        return $this->hasMany('App\Models\Education\Group', 'academic_year_id', 'id');
    }

    public function courses()
    {
        return $this->hasMany('App\Modals\Education\Course', 'academic_year_id');
    }
}
