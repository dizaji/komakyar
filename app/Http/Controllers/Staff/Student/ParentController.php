<?php

namespace App\Http\Controllers\Staff\Student;

use App\Http\Requests\Staff\Student\ParentRequest;
use App\Http\Requests\Staff\Student\StudentRequest;
use App\Models\User\Student;
use App\Models\User\StudentParent;
use App\Repositories\Staff\User\Student\ParentRepository;
use App\Tools\HttpResponse;
use App\Tools\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ParentController extends Controller
{
    protected $parentRepository;

    public function __construct(ParentRepository $parentRepository)
    {
        $this->parentRepository = $parentRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Student $student
     * @return \Illuminate\Http\Response
     */
    public function index(Student $student)
    {
        if (request()->expectsJson()) {
            return JsonResponse::successObject(HttpResponse::OK, $this->parentRepository->index($student));
        } else {
            abort(HttpResponse::BAD_REQUEST, "No view");
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StudentRequest|Request $request
     * @param Student $student
     * @return \Illuminate\Http\Response
     */
    public function store(ParentRequest $request, Student $student)
    {
        return JsonResponse::successObject(HttpResponse::CREATED, $this->parentRepository->store($request, $student));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param StudentRequest|Request $request
     * @param  \App\Models\User\Student $student
     * @return \Illuminate\Http\Response
     */
    public function update(ParentRequest $request, Student $student, StudentParent $parent)
    {
        return JsonResponse::successMessage(HttpResponse::OK, $this->parentRepository->update($request, $student, $parent));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User\Student $student
     * @param StudentParent $parent
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student, StudentParent $parent)
    {
        return JsonResponse::successMessage(HttpResponse::OK, $this->parentRepository->destroy($student, $parent));
    }
}
