<?php

namespace App\Http\Controllers\Staff\Lookup\Course;

use App\Http\Controllers\Controller;
use App\Http\Requests\Staff\Lookup\Course\CourseSourceRequest;
use App\Models\Lookup\CourseSource;
use App\Repositories\Staff\Lookup\Course\CourseSourceRepository;
use App\Tools\HttpResponse;
use App\Tools\JsonResponse;
use Illuminate\Http\Request;

class SourceController extends Controller
{
    /**
     * @var CourseSourceRepository
     */
    protected $courseSourceRepository;

    /**
     * SourceController constructor.
     * @param CourseSourceRepository $courseSourceRepository
     */
    public function __construct(CourseSourceRepository $courseSourceRepository)
    {
        $this->courseSourceRepository = $courseSourceRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->expectsJson()) {
            return JsonResponse::successObject($this->courseSourceRepository->index());
        } else {
            return view('staff.lookup.course.course_source');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CourseSourceRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseSourceRequest $request)
    {
        return JsonResponse::successObject($this->courseSourceRepository->store($request->all()));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CourseSourceRequest|Request $request
     * @param  \App\Models\Lookup\CourseSource $courseSource
     * @return \Illuminate\Http\Response
     */
    public function update(CourseSourceRequest $request, CourseSource $courseSource)
    {
        return JsonResponse::successObject($this->courseSourceRepository->update($request->all(), $courseSource));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lookup\CourseSource $courseSource
     * @return \Illuminate\Http\Response
     */
    public function destroy(CourseSource $courseSource)
    {
        if ($this->courseSourceRepository->destroy($courseSource)) {
           return JsonResponse::successMessage('Object has been deleted successfully');
        }

        abort(HttpResponse::INTERNAL_SERVER_ERROR);
    }
}
