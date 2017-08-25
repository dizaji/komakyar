<?php

namespace App\Repositories\Staff\Lookup\LevelField;

use App\Models\LevelField;
use App\Repositories\BaseRepository;
use App\Tools\Settings;
use Illuminate\Database\Eloquent\Builder;

class LevelFieldRepository extends BaseRepository
{
    public function index()
    {
        return $this->load(
            LevelField::query()
                ->where('is_visible', true)
//                ->orderBy('id', 'desc')
                ->take(Settings::LOAD_UNLIMIT)
        )->get();
    }

    public function show(LevelField $levelField)
    {
        return $this->load($levelField);
    }

    public function load($object)
    {
        if ($object instanceof LevelField) {
            return $object->load(['level', 'field']);
        } elseif ($object instanceof Builder) {
            return $object->with(['level', 'field']);
        }
    }
}