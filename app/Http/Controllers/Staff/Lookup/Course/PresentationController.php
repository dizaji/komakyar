<?php

namespace App\Http\Controllers\Staff\Lookup\Course;

use App\Http\Controllers\Controller;
use App\Models\Education\Course\Presentation;
use App\Repositories\Staff\Lookup\Course\PresentationRepository;
use App\Tools\JsonResponse;

class PresentationController extends Controller
{
    /**
     * @var PresentationRepository
     */
    protected $presentationRepository;

    /**
     * PresentationController constructor.
     * @param PresentationRepository $presentationRepository
     */
    public function __construct(PresentationRepository $presentationRepository)
    {
        $this->presentationRepository = $presentationRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return JsonResponse::successObject($this->presentationRepository->index());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Education\Course\Presentation  $presentation
     * @return \Illuminate\Http\Response
     */
    public function show(Presentation $presentation)
    {
        return $this->presentationRepository->show($presentation);
    }
}
