<?php

namespace App\Models\Education\Program;

use Illuminate\Database\Eloquent\Model;

class AnnualProgram extends Model
{
    protected $table = 'education_annual_programs';

    public function presentation()
    {
        return $this->belongsTo('App\Models\Education\Course\Presentation', 'presentation_id', 'id');
    }

    public function group()
    {
        return $this->belongsTo('App\Models\Education\Group\Group', 'group_id', 'id');
    }
}
