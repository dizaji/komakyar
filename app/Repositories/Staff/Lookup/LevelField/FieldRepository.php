<?php

namespace App\Repositories\Staff\Lookup\LevelField;

use App\Models\Lookup\Field;
use App\Repositories\BaseRepository;
use App\Tools\Settings;

class FieldRepository extends BaseRepository
{
    public function index()
    {
        return $this->load(
            Field::query()
                ->orderBy('id', 'desc')
                ->take(Settings::LOAD_UNLIMIT)
        )->get();
    }

    public function show(Field $field)
    {
        return $this->load($field);
    }

    public function load($object)
    {
        return $object;
    }
}