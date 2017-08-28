<?php

namespace App\Http\Controllers\Staff\Group;

use App\Http\Controllers\Controller;
use App\Models\Education\Group\Group;
use App\Models\User\Student;
use App\Repositories\Staff\Group\StudentRepository;
use App\Tools\HttpResponse;
use App\Tools\JsonResponse;

class StudentController extends Controller
{
    protected $studentRepository;

    public function __construct(StudentRepository $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Group $group
     * @return \Illuminate\Http\Response
     */
    public function index(Group $group)
    {
        if (request()->expectsJson()) {
            return JsonResponse::successObject($this->studentRepository->index($group));
        } else {
            abort(HttpResponse::NOT_IMPLEMENTED);
        }
    }

    /**
     * add specific student to current group
     *
     * @param Group $group
     * @param Student $student
     * @return \Illuminate\Http\Response
     */
    public function add(Group $group, Student $student)
    {
        if (request()->expectsJson()) {
            return JsonResponse::successObject($this->studentRepository->add($group, $student));
        } else {
            abort(HttpResponse::NOT_IMPLEMENTED);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Group $group
     * @param Student $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group, Student $student)
    {
        if (request()->expectsJson()) {
            return JsonResponse::successObject($this->studentRepository->destroy($group, $student));
        } else {
            abort(HttpResponse::NOT_IMPLEMENTED);
        }
    }
}
