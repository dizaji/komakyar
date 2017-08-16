<?php
/**
 * Created by PhpStorm.
 * User: Mohammad
 * Date: 8/16/2017
 * Time: 12:10 AM
 */

namespace App\Repositories\Staff\User\Student;


use App\Http\Requests\Staff\Student\ParentRequest;
use App\Models\User\Student;
use App\Models\User\StudentParent;
use App\Repositories\Staff\User\UserRepository;
use App\Tools\Settings;
use Illuminate\Database\Eloquent\Builder;

class ParentRepository
{
    protected $fillable = [
        'relative',
        'mobile_1',
        'mobile_2',
    ];
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(Student $student)
    {
        return $this->load($student->parents())->paginate(Settings::PAGINATION_LIMIT_STAFF);
    }

    public function store(ParentRequest $request, Student $student)
    {
        $user = $this->userRepository->fill($request->user);
        $user->is_parent=true;
        $user->save();

        $parent = $this->fill($request->all());
        $parent->student_id = $student->id;
        $user->parent()->save($parent);

        return $this->load($parent);
    }

    public function update(ParentRequest $request, Student $student, StudentParent $parent)
    {
        return null;
    }

    public function destroy(Student $student, StudentParent $parent)
    {
        return null;
    }

    public function fill(array $array, $object = null)
    {
        if (is_null($object)) {
            $object = new StudentParent();
        }

        return $object->fillable($this->fillable)->fill($array);
    }

    public function load($object)
    {
        if ($object instanceof Builder) {
            $object->with(['user']);
        } elseif($object instanceof StudentParent) {
            $object->load(['user']);
        }

        return $object;
    }
}