<?php

namespace App\Http\Controllers\Staff\Group;

use App\Http\Controllers\Controller;
use App\Http\Requests\Staff\Group\GroupRequest;
use App\Models\Education\Group\Group;
use App\Repositories\Staff\Group\GroupRepository;
use App\Tools\HttpResponse;
use App\Tools\JsonResponse;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    private $groups;

    public function __construct(GroupRepository $groups)
    {
        $this->groups = $groups;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->expectsJson()) {
            return JsonResponse::successObject($this->groups->index());
        } else {
            return view('staff.group.index');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param GroupRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(GroupRequest $request)
    {
        return JsonResponse::successObject($this->groups->store($request), HttpResponse::CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param Group $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        if (request()->expectsJson()) {
            return JsonResponse::successObject($this->groups->show($group));
        } else {
            return view('staff.group.show', ['group' => $group]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param GroupRequest|Request $request
     * @param Group $group
     * @return \Illuminate\Http\Response
     */
    public function update(GroupRequest $request, Group $group)
    {
        return JsonResponse::successObject($this->groups->update($request, $group));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
