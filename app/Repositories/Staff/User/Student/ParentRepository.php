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
use App\Repositories\BaseRepository;
use App\Repositories\Staff\User\UserRepository;
use App\Tools\Settings;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;

class ParentRepository extends BaseRepository
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
        return $this->load($student->parents())->orderBy('created_at', 'desc')->paginate(Settings::PAGINATION_LIMIT_STAFF);
    }

    public function store(ParentRequest $request, Student $student)
    {
        $user = $this->userRepository->fill($request->user, new User());
        $user->is_parent=true;
        $user->save();

        $parent = $this->fill($request->all(), new StudentParent());
        $parent->student_id = $student->id;
        $user->parent()->save($parent);

        return $this->load($parent);
    }

    public function update(ParentRequest $request, Student $student, StudentParent $parent)
    {
        $this->userRepository->fill($request->user, $parent->user)->save();
        $this->fill($request->all(), $parent)->update();
        return $this->load($parent);
    }

    public function destroy(Student $student, StudentParent $parent)
    {
        $user = $parent->user;
        $parent->delete();
        $user->delete();

        return true;
    }

    public function load($object)
    {
        if ($object instanceof Builder || $object instanceof Relation) {
            $object->with(['user']);
        } elseif($object instanceof StudentParent) {
            $object->load(['user']);
        }

        return $object;
    }
}