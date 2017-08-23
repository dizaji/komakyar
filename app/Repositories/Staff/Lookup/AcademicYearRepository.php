<?php

namespace App\Repositories\Staff\Lookup;

use App\Models\AcademicYear;
use App\Repositories\BaseRepository;
use App\Tools\Settings;

class AcademicYearRepository extends BaseRepository
{
    public function index()
    {
        return $this->load(
            AcademicYear::query()->orderBy('id', 'desc')->take(Settings::LOAD_UNLIMIT)
        )->get();
    }

    public function show(AcademicYear $year)
    {
        return $this->load($year);
    }

    public function load($object)
    {
        return $object;
    }
}