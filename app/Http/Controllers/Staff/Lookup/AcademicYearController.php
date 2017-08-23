<?php

namespace App\Http\Controllers\Staff\Lookup;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use App\Repositories\Staff\Lookup\AcademicYearRepository;
use App\Tools\HttpResponse;
use App\Tools\JsonResponse;
use Illuminate\Http\Request;

class AcademicYearController extends Controller
{
    /**
     * @var AcademicYearRepository
     */
    private $academicYearRepository;

    public function __construct(AcademicYearRepository $academicYearRepository)
    {
        $this->academicYearRepository = $academicYearRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->expectsJson()) {
            return JsonResponse::successObject(HttpResponse::OK, $this->academicYearRepository->index());
        } else {
            abort(HttpResponse::NOT_IMPLEMENTED);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param AcademicYear $year
     * @return \Illuminate\Http\Response
     */
    public function show(AcademicYear $year)
    {
        if (request()->expectsJson()) {
            return JsonResponse::successObject(HttpResponse::OK, $this->academicYearRepository->show($year));
        } else {
            abort(HttpResponse::NOT_IMPLEMENTED);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AcademicYear $academicYear
     * @return \Illuminate\Http\Response
     */
    public function edit(AcademicYear $academicYear)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\AcademicYear $academicYear
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AcademicYear $academicYear)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AcademicYear $academicYear
     * @return \Illuminate\Http\Response
     */
    public function destroy(AcademicYear $academicYear)
    {
        //
    }
}
