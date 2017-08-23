<?php

namespace App\Http\Controllers\Staff\Lookup\LevelField;

use App\Http\Controllers\Controller;
use App\Models\Lookup\Level;
use App\Repositories\Staff\Lookup\LevelField\LevelRepository;
use App\Tools\HttpResponse;
use App\Tools\JsonResponse;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    protected $levelRepository;

    public function __construct(LevelRepository $levelRepository)
    {
        $this->levelRepository = $levelRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->expectsJson()) {
            return JsonResponse::successMessage(HttpResponse::OK, $this->levelRepository->index());
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
     * @param  \App\Models\Lookup\Level $level
     * @return \Illuminate\Http\Response
     */
    public function show(Level $level)
    {
        if (request()->expectsJson()) {
            return JsonResponse::successMessage(HttpResponse::OK, $this->levelRepository->show($level));
        } else {
            abort(HttpResponse::NOT_IMPLEMENTED);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lookup\Level $level
     * @return \Illuminate\Http\Response
     */
    public function edit(Level $level)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Lookup\Level $level
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Level $level)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lookup\Level $level
     * @return \Illuminate\Http\Response
     */
    public function destroy(Level $level)
    {
        //
    }
}
