<?php

namespace App\Http\Controllers\Staff\Group\Course;

use App\Http\Controllers\Controller;
use App\Http\Requests\Staff\Group\GroupPresentedCourseRequest;
use App\Models\Education\Group\Group;
use App\Models\Education\Group\GroupPresentedCourse;
use App\Repositories\Staff\Group\GroupPresentedCourseRepository;
use App\Tools\JsonResponse;

class GroupPresentedCourseController extends Controller
{
    /**
     * @var GroupPresentedCourseRepository
     */
    protected $groupPresentedCourseRepository;

    /**
     * GroupPresentedCourseController constructor.
     * @param GroupPresentedCourseRepository $groupPresentedCourseRepository
     */
    public function __construct(GroupPresentedCourseRepository $groupPresentedCourseRepository)
    {
        $this->groupPresentedCourseRepository = $groupPresentedCourseRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  Group $group
     * @return \Illuminate\Http\Response
     */
    public function index(Group $group)
    {
        return JsonResponse::successObject($this->groupPresentedCourseRepository->index($group));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  GroupPresentedCourseRequest $request
     * @param  Group $group
     * @return \Illuminate\Http\Response
     */
    public function store(GroupPresentedCourseRequest $request, Group $group)
    {
        return JsonResponse::successObject($this->groupPresentedCourseRepository->store($request->all(), $group));
    }

    /**
     * Display the specified resource.
     *
     * @param  Group $group
     * @param  \App\Models\Education\Group\GroupPresentedCourse $groupPresentedCourse
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group, GroupPresentedCourse $groupPresentedCourse)
    {
        return JsonResponse::successObject($this->groupPresentedCourseRepository->show($groupPresentedCourse));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  GroupPresentedCourseRequest $request
     * @param  Group $group
     * @param  \App\Models\Education\Group\GroupPresentedCourse $groupPresentedCourse
     * @return \Illuminate\Http\Response
     */
    public function update(GroupPresentedCourseRequest $request, Group $group, GroupPresentedCourse $groupPresentedCourse)
    {
        return JsonResponse::successObject($this->groupPresentedCourseRepository->update($request->all(), $groupPresentedCourse));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Group $group
     * @param  \App\Models\Education\Group\GroupPresentedCourse $groupPresentedCourse
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group, GroupPresentedCourse $groupPresentedCourse)
    {
        $this->groupPresentedCourseRepository->destroy($groupPresentedCourse);

        return JsonResponse::successMessage('Object has been deleted successfully');
    }
}
