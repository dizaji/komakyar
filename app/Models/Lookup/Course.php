<?php

namespace App\Models\Lookup;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'lookup_courses';

    public function levelField()
    {
        return $this->belongsTo('App\Models\LevelField', 'level_field_id', 'id');
    }
}
