<?php
/**
 * Created by PhpStorm.
 * User: Mohammad
 * Date: 8/14/2017
 * Time: 10:35 PM
 */

namespace App\Repositories\Staff\User\Student;


use App\Http\Requests\General\DisplayPictureRequest;
use App\Models\User\Student;
use App\Repositories\BaseRepository;
use App\Repositories\Staff\User\UserRepository;
use App\Tools\FileHelper;
use App\Tools\Settings;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Input;

class StudentRepository extends BaseRepository
{
    protected $userRepository;
    protected $fillable = [
        'student_code',
        'date_of_birth',
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
        return $this->load(
            Student::query()
                ->whereHas('user', function ($query) {
                    $query->when(!is_null(Input::get('first_name')), function ($query) {
                        $query->where('first_name', 'like', '%' . Input::get('first_name') . '%');
                    })->when(!is_null(Input::get('surname')), function ($query) {
                        $query->where('surname', 'like', '%' . Input::get('surname') . '%');
                    })->when(!is_null(Input::get('national_code')), function ($query) {
                        $query->where('national_code', 'like', '%' . Input::get('national_code') . '%');
                    })->when(!is_null(Input::get('email')), function ($query) {
                        $query->where('email', 'like', '%' . Input::get('email') . '%');
                    });
                })->when(!is_null(Input::get('student_code')), function ($query) {
                    $query->where('student_code', 'like', '%' . Input::get('student_code') . '%');
                })
        )->paginate(Settings::STUDENT_LOAD_LIMIT);
    }

    public function store(array $data)
    {
        $student = $this->fill($data, new Student());
        $user = $this->userRepository->fill($data['user'], new User());

        $user->is_student = true;

        $user->save();
        $user->student()->save($student);

        return $this->load($student);
    }

    public function show(Student $student)
    {
        return $this->load($student);
    }

    public function update(array $data, Student $student)
    {
        $this->fill($data, $student)->save();
        $this->userRepository->fill($data['user'], $student->user)->save();

        return $this->load($student);
    }

    public function destroy(Student $student)
    {
        return true;
    }

    public function uploadDisplayPicture(DisplayPictureRequest $request, Student $student)
    {
        $new_dp_path = FileHelper::store($request->file('file'), 'file.images.user.profile_picture.path');

        $user = $student->user;
        FileHelper::delete($user->profile_picture);
        $user->profile_picture = $new_dp_path;
        $user->save();

        return ['url' => $user->profile_picture];
    }

    public function changePassword(array $data, Student $student)
    {
        return $this->userRepository->fill($data, $student->user)->save();
    }

    public function load($object)
    {
        if ($object instanceof Student) {
            $object->load(['user']);
        } elseif ($object instanceof Builder) {
            return $object->with(['user']);
        }

        return $object;
    }
}