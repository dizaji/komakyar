<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LevelField extends Model
{
    public function levels()
    {
        return $this->belongsTo('App\Models\Lookup\Level', 'level_id', 'id');
    }

    public function fields()
    {
        return $this->belongsTo('App\Models\Lookup\Field', 'field_id', 'id');
    }

    public function courseSources()
    {
        return $this->hasMany('App\Models\Lookup\CourseSource', 'level_field_id', 'id');
    }
}
