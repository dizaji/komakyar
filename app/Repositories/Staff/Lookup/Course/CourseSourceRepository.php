<?php
/**
 * Created by PhpStorm.
 * User: Mohammad
 * Date: 8/28/2017
 * Time: 11:45 PM
 */

namespace App\Repositories\Staff\Lookup\Course;


use App\Models\Lookup\CourseSource;
use App\Repositories\BaseRepository;
use App\Tools\Settings;
use Illuminate\Support\Facades\Input;

class CourseSourceRepository extends BaseRepository
{
    protected $fillable = [
        'reference_name',
        'reference_code',
    ];

    public function index($window_size = Settings::PAGINATION_COURSE_SOURCE_LIMIT)
    {
        return $this->load(
            CourseSource::query()
                ->when(!is_null(Input::get('reference_name')), function ($query) {
                    $query->where('reference_name', 'like', '%' . Input::get('reference_name') . '%');
                })
                ->when(!is_null(Input::get('reference_code')), function ($query) {
                    $query->where('reference_code', 'like', '%' . Input::get('reference_code') . '%');
                })
        )->paginate($window_size);
    }

    public function store(array $data)
    {
        $courseSource = $this->fill($data, new CourseSource());
        $courseSource->save();

        return $this->load($courseSource);
    }

    public function update(array $data, CourseSource $courseSource)
    {
        $this->fill($data, $courseSource)->save();

        return $this->load($courseSource);
    }

    public function destroy(CourseSource $courseSource)
    {
        return $courseSource->delete();
    }

    public function load($object)
    {
        return $object;
    }
}