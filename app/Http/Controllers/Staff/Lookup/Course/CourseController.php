<?php

namespace App\Http\Controllers\Staff\Lookup\Course;

use App\Http\Controllers\Controller;
use App\Http\Requests\Staff\Lookup\Course\CourseRequest;
use App\Models\Education\Course\Course;
use App\Repositories\Staff\Lookup\Course\CourseRepository;
use App\Tools\HttpResponse;
use App\Tools\JsonResponse;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    protected $courseRepository;

    public function __construct(CourseRepository $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->expectsJson()){
            return JsonResponse::successObject($this->courseRepository->index());
        } else {
            return view('staff.lookup.course.course');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CourseRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseRequest $request)
    {
        return JsonResponse::successObject($this->courseRepository->store($request->all()));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CourseRequest|Request $request
     * @param  \App\Models\Education\Course\Course $course
     * @return \Illuminate\Http\Response
     */
    public function update(CourseRequest $request, Course $course)
    {
        return JsonResponse::successObject($this->courseRepository->update($request->all(), $course));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Education\Course\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        if ($this->courseRepository->destroy($course)) {
            return JsonResponse::successMessage('Object has been deleted successfully');
        }

        abort(HttpResponse::INTERNAL_SERVER_ERROR);
    }
}
