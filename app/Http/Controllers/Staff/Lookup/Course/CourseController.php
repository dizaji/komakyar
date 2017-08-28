<?php

namespace App\Http\Controllers\Staff\Lookup\Course;

use App\Http\Controllers\Controller;
use App\Http\Requests\Staff\Lookup\Course\CourseRequest;
use App\Models\Education\Course\Course;
use App\Tools\JsonResponse;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function __construct()
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->expectsJson()){
            return JsonResponse::successObject();
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Education\Course\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        //
    }
}
