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

    public function fill($array, $object = null)
    {
        if(is_null($object)){
            $object = (new Student());
        }

        $object->fillable($this->fillable)->fill($array);

        return $object;
    }
}