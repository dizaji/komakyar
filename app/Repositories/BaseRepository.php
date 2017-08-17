<?php

namespace App\Repositories;

abstract class BaseRepository
{
    protected $fillable = [];

    public function fill(array $array, $object, $fillable = [])
    {
        if(empty($fillable)) {
            $fillable = $this->fillable;
        }

        return $object->fillable($fillable)->fill($array);
    }
}