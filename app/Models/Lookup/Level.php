<?php

namespace App\Models\Lookup;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $table = 'lookup_levels';

    public function levelFields()
    {
        return $this->hasMany('App\Models\LevelField', 'level_id', 'id');
    }
}
