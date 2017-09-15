<?php

namespace App\Http\Controllers\Staff\Group\Course;

use App\Http\Controllers\Controller;
use App\Http\Requests\Staff\Group\PresentationRequest;
use App\Models\Education\Group\Group;
use App\Models\Education\Group\GroupPresentedCourses;
use App\Repositories\Staff\Group\PresentationRepository;
use App\Tools\JsonResponse;

class PresentationController extends Controller
{
    /**
     * @var PresentationRepository
     */
    protected $groupPresentedCoursesRepository;

    /**
     * GroupPresentedCoursesController constructor.
     * @param PresentationRepository $groupPresentedCoursesRepository
     */
    public function __construct(PresentationRepository $groupPresentedCoursesRepository)
    {
        $this->groupPresentedCoursesRepository = $groupPresentedCoursesRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  Group $group
     * @return \Illuminate\Http\Response
     */
    public function index(Group $group)
    {
        return JsonResponse::successObject($this->groupPresentedCoursesRepository->index($group));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PresentationRequest $request
     * @param  Group $group
     * @return \Illuminate\Http\Response
     */
    public function store(PresentationRequest $request, Group $group)
    {
        return JsonResponse::successObject($this->groupPresentedCoursesRepository->store($request->all(), $group));
    }

    /**
     * Display the specified resource.
     *
     * @param  Group $group
     * @param  \App\Models\Education\Group\GroupPresentedCourses $groupPresentedCourses
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group, GroupPresentedCourses $groupPresentedCourses)
    {
        return JsonResponse::successObject($this->groupPresentedCoursesRepository->show($groupPresentedCourses));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PresentationRequest $request
     * @param  Group $group
     * @param  \App\Models\Education\Group\GroupPresentedCourses $groupPresentedCourses
     * @return \Illuminate\Http\Response
     */
    public function update(PresentationRequest $request, Group $group, GroupPresentedCourses $groupPresentedCourses)
    {
        return JsonResponse::successObject($this->groupPresentedCoursesRepository->update($request->all(), $groupPresentedCourses));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Group $group
     * @param  \App\Models\Education\Group\GroupPresentedCourses $groupPresentedCourses
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group, GroupPresentedCourses $groupPresentedCourses)
    {
        return JsonResponse::successObject($this->groupPresentedCoursesRepository->destroy($groupPresentedCourses));
    }
}
