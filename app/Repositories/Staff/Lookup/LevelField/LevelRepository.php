<?php

namespace App\Repositories\Staff\Lookup\LevelField;

use App\Models\Lookup\Level;
use App\Repositories\BaseRepository;
use App\Tools\Settings;

class LevelRepository extends BaseRepository
{
    public function index()
    {
        return $this->load(
            Level::query()
                ->orderBy('id', 'desc')
                ->take(Settings::LOAD_UNLIMIT)
        )->get();
    }

    public function show(Level $level)
    {
        return $this->load($level);
    }

    public function load($object)
    {
        return $object;
    }
}