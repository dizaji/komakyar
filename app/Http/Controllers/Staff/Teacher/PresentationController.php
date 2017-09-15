<?php

namespace App\Http\Controllers\Staff\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\Staff\Teacher\PresentationRequest;
use App\Models\Education\Course\Presentation;
use App\Models\User\Teacher\Teacher;
use App\Repositories\Staff\User\Teacher\PresentationRepository;
use App\Tools\HttpResponse;
use App\Tools\JsonResponse;
use Illuminate\Http\Request;

class PresentationController extends Controller
{
    /**
     * @var PresentationRepository
     */
    protected $presentationRepository;

    /**
     * PresentationController constructor.
     *
     * @param PresentationRepository $presentationRepository
     */
    public function __construct(PresentationRepository $presentationRepository)
    {
        $this->presentationRepository = $presentationRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Teacher $teacher
     * @return \Illuminate\Http\Response
     */
    public function index(Teacher $teacher)
    {
        return JsonResponse::successObject($this->presentationRepository->index($teacher));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PresentationRequest|Request $request
     * @param  Teacher $teacher
     * @return \Illuminate\Http\Response
     */
    public function store(PresentationRequest $request, Teacher $teacher)
    {
        return JsonResponse::successObject($this->presentationRepository->store($request->all(), $teacher), HttpResponse::CREATED);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PresentationRequest|Request $request
     * @param  Teacher $teacher
     * @param  \App\Models\Education\Course\Presentation $presentation
     * @return \Illuminate\Http\Response
     */
    public function update(PresentationRequest $request, Teacher $teacher, Presentation $presentation)
    {
        return JsonResponse::successObject($this->presentationRepository->update($request->all(), $teacher, $presentation));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Teacher $teacher
     * @param  \App\Models\Education\Course\Presentation $presentation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher, Presentation $presentation)
    {
        if($this->presentationRepository->destroy($teacher, $presentation)) {

            return JsonResponse::successMessage("Object has been deleted successfully");
        } else {
            return JsonResponse::successMessage('delete error', HttpResponse::BAD_REQUEST);
        }

    }
}
