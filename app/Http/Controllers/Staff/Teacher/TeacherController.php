<?php

namespace App\Http\Controllers\Staff\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\General\ChangePasswordRequest;
use App\Http\Requests\General\DisplayPictureRequest;
use App\Http\Requests\Staff\Teacher\TeacherRequest;
use App\Models\User\Teacher\Teacher;
use App\Repositories\Staff\User\Teacher\TeacherRepository;
use App\Tools\HttpResponse;
use App\Tools\JsonResponse;

class TeacherController extends Controller
{
    protected $teacherRepository;

    public function __construct(TeacherRepository $teacherRepository)
    {
        $this->teacherRepository = $teacherRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->expectsJson()) {
            return JsonResponse::successObject($this->teacherRepository->index());
        } else {
            return view('staff.teacher.index');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TeacherRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeacherRequest $request)
    {
        return JsonResponse::successObject($this->teacherRepository->store($request->all()), HttpResponse::CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param Teacher $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        if (request()->expectsJson()) {
            return JsonResponse::successObject($this->teacherRepository->show($teacher));
        } else {
            return view('staff.teacher.show', ['teacher' => $teacher]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TeacherRequest $request
     * @param Teacher $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(TeacherRequest $request, Teacher $teacher)
    {
        return JsonResponse::successObject($this->teacherRepository->update($request->all(), $teacher));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function uploadDisplayPicture(DisplayPictureRequest $request, Teacher $teacher)
    {
        return JsonResponse::successObject($this->teacherRepository->uploadDisplayPicture($request, $teacher));
    }


    public function changePassword(ChangePasswordRequest $request, Teacher $teacher)
    {
        $this->teacherRepository->changePassword($request->all(), $teacher);

        return JsonResponse::successMessage("Password has been changed successfully");
    }
}
