<?php
/**
 * Created by PhpStorm.
 * User: Mohammad
 * Date: 8/25/2017
 * Time: 3:42 PM
 */

namespace App\Repositories\Staff\Group;


use App\Models\Education\Group\Group;
use App\Models\User\Student;
use App\Tools\Settings;
use Illuminate\Support\Facades\Input;

class StudentRepository
{
    protected $mainStudentRepository;

    public function __construct(\App\Repositories\Staff\User\Student\StudentRepository $mainStudentRepository)
    {
        $this->mainStudentRepository = $mainStudentRepository;
    }

    public function index(Group $group, $window_size = Settings::PAGINATION_GROUP_STUDENT_LIMIT)
    {
        $students = $this->mainStudentRepository->load(
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
                })->when(Input::get('all') != true, function ($query) use ($group) {
                    $query->whereHas('groups', function ($query) use ($group) {
                        $query->where($group->getTable() . '.id', $group->id);
                    });
                })/*->with(['groups' => function($query) use ($group) {
                    $query->where($group->getTable() . '.id', $group->id);
                }])*/
        )->paginate($window_size);

        foreach ($students as $student) {
            $student->current_group = ($student->groups()->where($group->getTable() . '.id', $group->id)->exists());
        }

        return $students;
    }

    public function add(Group $group, Student $student)
    {
        if (!$student->groups()->where($group->getTable() . '.id', $group->id)->exists()) {
            $group->students()->attach($student->id);
        }

        $student = $this->mainStudentRepository->load($student);
        $student->current_group = ($student->groups()->where($group->getTable() . '.id', $group->id)->exists());

        return $student;
    }

    public function destroy(Group $group, Student $student)
    {
        if ($student->groups()->where($group->getTable() . '.id', $group->id)->exists()) {
            $group->students()->detach($student->id);
        }

        $student = $this->mainStudentRepository->load($student);
        $student->current_group = ($student->groups()->where($group->getTable() . '.id', $group->id)->exists());

        return $student;
    }
}