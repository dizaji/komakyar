<?php
/**
 * Created by PhpStorm.
 * User: Mohammad
 * Date: 8/28/2017
 * Time: 11:45 PM
 */

namespace App\Repositories\Staff\Lookup\Course;


use App\Models\Education\Course\Course;
use App\Repositories\BaseRepository;
use App\Tools\Settings;
use Illuminate\Support\Facades\Input;

class CourseRepository extends BaseRepository
{

    protected $fillable = [
        'reference_name',
        'reference_code',
        'title',
        'multiplier',
    ];

    public function index($window_size = Settings::PAGINATION_COURSE_SOURCE_LIMIT)
    {
        return $this->load(
            Course::query()
                ->when(is_null(Input::get('all')) || Input::get('all') == false, function ($query) {
                    $query->where('is_available', true);
                })
                ->when(!is_null(Input::get('reference_name')), function ($query) {
                    $query->where('reference_name', 'like', '%' . Input::get('reference_name') . '%');
                })
                ->when(!is_null(Input::get('reference_code')), function ($query) {
                    $query->where('reference_code', 'like', '%' . Input::get('reference_code') . '%');
                })
                ->when(is_numeric(Input::get('multiplier')), function ($query) {
                    $query->where('multiplier', '=', Input::get('multiplier'));
                })
                ->when(!is_null(Input::get('title')), function ($query) {
                    $query->where('title', 'like', '%' . Input::get('title') . '%');
                })
        )->paginate($window_size);
    }

    public function store(array $data)
    {
        $courseSource = $this->fill($data, new Course());
        $courseSource->save();

        return $this->load($courseSource);
    }

    public function update(array $data, Course $course)
    {
        $this->fill($data, $course)->save();

        return $this->load($course);
    }

    public function destroy(Course $course)
    {
        return $course->delete();
    }

    public function load($object)
    {
        return $object;
    }
}