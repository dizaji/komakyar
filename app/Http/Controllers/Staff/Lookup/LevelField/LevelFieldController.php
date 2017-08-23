<?php

namespace App\Http\Controllers\Staff\Lookup\LevelField;

use App\Http\Controllers\Controller;
use App\Models\LevelField;
use App\Repositories\Staff\Lookup\LevelField\LevelFieldRepository;
use App\Tools\HttpResponse;
use App\Tools\JsonResponse;
use Illuminate\Http\Request;

class LevelFieldController extends Controller
{
    protected $levelFieldRepository;

    public function __construct(LevelFieldRepository $levelFieldRepository)
    {
        $this->levelFieldRepository = $levelFieldRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->expectsJson()) {
            return JsonResponse::successMessage(HttpResponse::OK, $this->levelFieldRepository->index());
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
     * @param  \App\Models\LevelField $levelField
     * @return \Illuminate\Http\Response
     */
    public function show(LevelField $levelField)
    {
        if (request()->expectsJson()) {
            return JsonResponse::successMessage(HttpResponse::OK, $this->levelFieldRepository->show($levelField));
        } else {
            abort(HttpResponse::NOT_IMPLEMENTED);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LevelField $levelField
     * @return \Illuminate\Http\Response
     */
    public function edit(LevelField $levelField)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\LevelField $levelField
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LevelField $levelField)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LevelField $levelField
     * @return \Illuminate\Http\Response
     */
    public function destroy(LevelField $levelField)
    {
        //
    }
}
