<?php

namespace App\Models\Education\Schedule;

use Illuminate\Database\Eloquent\Model;

class AnnualProgram extends Model
{
    protected $table = 'education_annual_programs';

    public function presentation()
    {
        return $this->belongsTo('App\Models\Education\Course\Presentation', 'presentation_id', 'id');
    }
}
