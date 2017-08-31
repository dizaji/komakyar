<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LevelField extends Model
{
    public function level()
    {
        return $this->belongsTo('App\Models\Lookup\Level', 'level_id', 'id');
    }

    public function field()
    {
        return $this->belongsTo('App\Models\Lookup\Field', 'field_id', 'id');
    }

    public function groups()
    {
        return $this->hasMany('App\Models\Education\Group\Group', 'level_field_id', 'id');
    }
}
