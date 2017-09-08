<?php

namespace App\Repositories\Staff\User\Teacher;


use App\Http\Requests\General\DisplayPictureRequest;
use App\Models\User\Teacher\Teacher;
use App\Repositories\BaseRepository;
use App\Repositories\Staff\User\UserRepository;
use App\Tools\FileHelper;
use App\Tools\Settings;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Input;

class TeacherRepository extends BaseRepository
{
    protected $userRepository;
    protected $fillable = [
        'degree',
        'field_of_study',
        'description',
        'mobile',
    ];

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        return $this->load(
            Teacher::query()
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
                })->when(!is_null(Input::get('mobile')), function ($query) {
                    $query->where('mobile', 'like', '%' . Input::get('mobile') . '%');
                })
        )->paginate(Settings::PAGINATION_TEACHERS_LIMIT);

//        return $this->load(
//            Teacher::query()
//                ->whereHas('user', function ($query) {
//                }))->paginate(Settings::PAGINATION_TEACHERS_LIMIT);
//
////        return $this->load(Teacher::all())->paginate(Settings::TEACHER_LOAD_LIMIT);
////        return $this->load(Teacher::find(1))->paginate(Settings::TEACHER_LOAD_LIMIT);
    }

    public function store(array $data)
    {
        $teacher = $this->fill($data, new Teacher());
        $user = $this->userRepository->fill($data['user'], new User());

        $user->is_teacher = true;

        $user->save();
        $user->teacher()->save($teacher);

        return $this->load($teacher);
    }

    public function show(Teacher $teacher)
    {
        return $this->load($teacher);
    }

    public function update(array $data, Teacher $teacher)
    {
        $this->fill($data, $teacher)->save();
        $this->userRepository->fill($data['user'], $teacher->user)->save();

        return $this->load($teacher);
    }

    public function uploadDisplayPicture(DisplayPictureRequest $request, Teacher $teacher)
    {
        $new_dp_path = FileHelper::store($request->file('file'), 'file.images.user.profile_picture.path');

        $user = $teacher->user;
        FileHelper::delete($user->profile_picture);
        $user->profile_picture = $new_dp_path;
        $user->save();

        return ['url' => $user->profile_picture];
    }

    public function changePassword(array $data, Teacher $teacher)
    {

        return $this->userRepository->fill($data, $teacher->user)->save();
    }

    public function load($object)
    {
        if ($object instanceof Teacher) {
            $object->load(['user']);
        } elseif ($object instanceof Builder) {
            return $object->with(['user']);
        }

        return $object;
    }
}
