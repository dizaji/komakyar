<?php

namespace App\Http\Controllers\Staff\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\General\ChangePasswordRequest;
use App\Http\Requests\General\DisplayPictureRequest;
use App\Http\Requests\Staff\Student\StudentRequest;
use App\Models\User\Student;
use App\Repositories\Staff\User\Student\StudentRepository;
use App\Tools\HttpResponse;
use App\Tools\JsonResponse;
use Illuminate\Http\Request;

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
            return JsonResponse::successObject($this->studentRepository->index());
        } else {
            return view('staff.student.index');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StudentRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request)
    {
        return JsonResponse::successObject($this->studentRepository->store($request->all()), HttpResponse::CREATED);

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
            return JsonResponse::successObject($this->studentRepository->show($student));
        } else {
            return view('staff.student.show', ['student' => $student]);
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
        return JsonResponse::successObject($this->studentRepository->update($request->all(), $student));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User\Student $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        return JsonResponse::successMessage($this->studentRepository->destroy($student));
    }

    public function uploadDisplayPicture(DisplayPictureRequest $request, Student $student)
    {
        return JsonResponse::successObject($this->studentRepository->uploadDisplayPicture($request, $student));
    }

    public function changePassword(ChangePasswordRequest $request, Student $student)
    {
        $this->studentRepository->changePassword($request->all(), $student);

        return JsonResponse::successMessage("Password has been changed successfully");
    }
}
