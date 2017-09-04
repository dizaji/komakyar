<?php

namespace App\Http\Controllers\Staff\Teacher;



use App\Http\Requests\Staff\Teacher\ChangePasswordRequest;
use App\Http\Requests\Staff\Teacher\TeacherRequest;
use App\Models\User\Teacher\Teacher;
use App\Repositories\Staff\User\Teacher\TeacherRepository;
use App\Tools\HttpResponse;
use App\Tools\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


/**
 * @property  TeacherRepository
 */
class TeacherController extends Controller
{
    protected $teacherRepository;

    public function __construct(TeacherRepository $teacherRepository)
    {
        $this->teacherRepository = $teacherRepository;
    }
    public function index()
    {
//        $myfile = fopen("newfile.txt", "a") or die("Unable to open file!");
//
//        fwrite($myfile, "index");
//
//
//        fclose($myfile);
        if (request()->expectsJson()) {
//            $myfile = fopen("newfile3.txt", "a") or die("Unable to open file!");
////
//            fwrite($myfile, (JsonResponse::successObject($this->teacherRepository->index())));
//
//
//            fclose($myfile);
            return JsonResponse::successObject($this->teacherRepository->index());
        } else {
            return view('staff.teacher.index');
        }

    }
//
    public function store(TeacherRequest $request)
    {
//
        return JsonResponse::successObject($this->teacherRepository->store($request), HttpResponse::CREATED);

    }
    public function update(TeacherRequest $request, Teacher $teacher)
    {
        return JsonResponse::successObject($this->teacherRepository->update($request, $teacher));
    }

    public function show(Teacher $teacher)
    {
        if (request()->expectsJson()) {
            return JsonResponse::successObject($this->teacherRepository->show($teacher));
        } else {
            return view('staff.teacher.show', ['teacher' => $teacher]);
        }
    }
    public function changePassword(ChangePasswordRequest $request, Teacher $teacher)
    {

        $this->teacherRepository->changePassword($request, $teacher);

        return JsonResponse::successMessage("Password has been changed successfully");
    }
}
