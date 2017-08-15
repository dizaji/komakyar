<?php

namespace App\Http\Controllers\Staff\Student;

use App\Http\Requests\Staff\Student\StudentRequest;
use App\Models\User\Student;
use App\Repositories\Staff\User\Student\StudentRepository;
use App\Tools\HttpResponse;
use App\Tools\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->expectsJson()) {
            return JsonResponse::successObject(HttpResponse::OK, $this->studentRepository->index());
        } else {
            return view('staff.student.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('staff.student.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StudentRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request)
    {
        return JsonResponse::successObject(HttpResponse::CREATED, $this->studentRepository->store($request));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User\Student $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        if (request()->expectsJson()) {
            return JsonResponse::successObject(HttpResponse::OK, $this->studentRepository->show($student));
        } else {
            return view('staff.student.show', ['student' => $student]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User\Student $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        if (request()->expectsJson()) {
            return JsonResponse::successObject(HttpResponse::OK, $this->studentRepository->edit($student));
        } else {
            return view('staff.student.edit', ['student' => $student]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StudentRequest|Request $request
     * @param  \App\Models\User\Student $student
     * @return \Illuminate\Http\Response
     */
    public function update(StudentRequest $request, Student $student)
    {
        return JsonResponse::successMessage(HttpResponse::OK, $this->studentRepository->update($request, $student));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User\Student $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        return JsonResponse::successMessage(HttpResponse::OK, $this->studentRepository->destroy($student));
    }
}
