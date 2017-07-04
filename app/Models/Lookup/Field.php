<?php

namespace App\Models\Lookup;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    protected $table = 'lookup_fields';

    public function levelFields()
    {
        return $this->hasMany('App\Models\LevelField', 'field_id', 'id');
    }
}
