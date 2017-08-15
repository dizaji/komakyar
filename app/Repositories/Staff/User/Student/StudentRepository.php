<?php
/**
 * Created by PhpStorm.
 * User: Mohammad
 * Date: 8/14/2017
 * Time: 10:35 PM
 */

namespace App\Repositories\Staff\User\Student;


use App\Http\Requests\Staff\Student\StudentRequest;
use App\Models\User\Student;
use App\Repositories\Staff\User\UserRepository;
use App\Tools\Settings;

class StudentRepository
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

    public function store(StudentRequest $request)
    {
        $student = $this->fill($request->all());
        $user = $this->userRepository->fill($request->user);

        $user->is_student = true;

        $user->save();
        $user->student()->save($student);

        return $student;
    }

    public function show(Student $student)
    {
        return $this->load($student);
    }

    public function edit(Student $student)
    {
        return $this->show($student);
    }

    public function update(StudentRequest $request, Student $student)
    {
        return $student;
    }

    public function destroy(Student $student)
    {
        return true;
    }

    public function fill($array, $object = null)
    {
        if(is_null($object)){
            $object = (new Student());
        }

        $object->fillable($this->fillable)->fill($array);

        return $object;
    }

    public function load($object)
    {
        $parent_query = function ($query) {
            $query->take(Settings::PARENT_LIMIT);
        };
        $group_student_query = function ($query) {
            $query->take(Settings::GROUP_STUDENT_LIMIT);
            $query->with('group');
        };

        if($object instanceof Student) {
            return $object->load([
                'user',
                'parents' => $parent_query,
                'groupStudents' => $group_student_query,
            ]);
        }

        return $object;
    }
}