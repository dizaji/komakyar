<?php
/**
 * Created by PhpStorm.
 * User: Mohammad
 * Date: 9/12/2017
 * Time: 11:45 PM
 */

namespace App\Repositories\Staff\User\Teacher;


use App\Models\Education\Course\Presentation;
use App\Models\User\Teacher\Teacher;
use App\Repositories\BaseRepository;
use App\Tools\Settings;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;

class PresentationRepository extends BaseRepository
{
    protected $fillable= [
        'course_id',
        'description'
    ];

    public function index(Teacher $teacher, $window_size = Settings::PAGINATION_TEACHER_PRESENTATION_LIMIT)
    {
        return $this->load($teacher->presentations())->paginate($window_size);
    }

    public function store(array $data, Teacher $teacher)
    {
        return $this->load($teacher->presentations()->save($this->fill($data, new Presentation())));
    }

    public function update(array $data, Teacher $teacher, Presentation $presentation)
    {
        $this->fill($data, $presentation)->save();

        return $this->load($presentation);
    }

    public function destroy(Teacher $teacher, Presentation $presentation)
    {
        return $presentation->delete();
    }

    public function load($object)
    {
        if($object instanceof Presentation) {
            $object->load(['course', 'annualPrograms']);
        } elseif ($object instanceof Builder || $object instanceof Relation) {
            $object->with(['course']);
        }

        return $object;
    }
}