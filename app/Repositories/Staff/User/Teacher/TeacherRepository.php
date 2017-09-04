<?php
/**
 * Created by PhpStorm.
 * User: Mohammad
 * Date: 8/14/2017
 * Time: 10:35 PM
 */

namespace App\Repositories\Staff\User\Teacher;




use App\Http\Requests\Staff\Teacher\ChangePasswordRequest;
use App\Http\Requests\Staff\Teacher\TeacherRequest;
use App\Models\User\Teacher\Teacher;
use App\Repositories\BaseRepository;
use App\Repositories\Staff\User\UserRepository;
use App\Tools\Settings;
use App\User;
use Illuminate\Database\Eloquent\Builder;

class TeacherRepository extends BaseRepository
{
    protected $userRepository;
    protected $fillable = [
        'user_id',
        'degree',
        'field_of_study',
        'description',
        'is_visible',
        'phone',
        'mobile',
        'address',
    ];

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function index()
    {
//        return $this->load(
//            Teacher::query()
//                ->whereHas('user', function ($query) {
//                    $query->when(!is_null(Input::get('first_name')), function ($query) {
//                        $query->where('first_name', 'like', '%' . Input::get('first_name') . '%');
//                    })->when(!is_null(Input::get('surname')), function ($query) {
//                        $query->where('surname', 'like', '%' . Input::get('surname') . '%');
//                    })->when(!is_null(Input::get('national_code')), function ($query) {
//                        $query->where('national_code', 'like', '%' . Input::get('national_code') . '%');
//                    })->when(!is_null(Input::get('email')), function ($query) {
//                        $query->where('email', 'like', '%' . Input::get('email') . '%');
//                    });
//                })->when(!is_null(Input::get('user_id')), function ($query) {
//                    $query->where('user_id', 'like', '%' . Input::get('user_id') . '%');
//                })
//        )->paginate(Settings::TEACHER_LOAD_LIMIT);

        return $this->load(
            Teacher::query()
                ->whereHas('user', function ($query) {}))->paginate(Settings::TEACHER_LOAD_LIMIT);

//        return $this->load(Teacher::all())->paginate(Settings::TEACHER_LOAD_LIMIT);
//        return $this->load(Teacher::find(1))->paginate(Settings::TEACHER_LOAD_LIMIT);
    }
    public function store(TeacherRequest $request)
    {
//        $myfile = fopen("newfile.txt", "a") or die("Unable to open file!");
//
//        fwrite($myfile, $request);
//
//
//        fclose($myfile);
      $teacher = $this->fill($request->all(), new Teacher());
        $user = $this->userRepository->fill($request->user, new User());

        $user->is_teacher = true;

        $user->save();
       $user->teacher()->save($teacher);

        return $this->load($teacher);
    }
    public function changePassword(ChangePasswordRequest $request, Teacher $teacher)
    {

        return $this->userRepository->fill($request->all(), $teacher->user)->save();
    }
    public function load($object)
    {
//        $parent_query = function ($query) {
//            $query->take(Settings::PARENT_LIMIT);
//        };
//        $group_student_query = function ($query) {
//            $query->take(Settings::GROUP_STUDENT_LIMIT);
//            $query->with('group');
//        };

        if ($object instanceof Teacher) {
            $object->load(['user']);
        } elseif ($object instanceof Builder) {
            return $object->with(['user']);
        }

        return $object;
    }
    public function update(TeacherRequest $request, Teacher $teacher)
    {
        $this->fill($request->all(), $teacher)->save();
        $this->userRepository->fill($request->user, $teacher->user)->save();

        return $this->load($teacher);
    }
    public function show(Teacher $teacher)
    {

        return $this->load($teacher);
    }
}
