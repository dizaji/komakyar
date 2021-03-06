<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    protected $table = 'academic_years';

    public function groups()
    {
        return $this->hasMany('App\Models\Education\Group\Group', 'academic_year_id', 'id');
    }
}
