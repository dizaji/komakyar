<?php

namespace App\Http\Controllers\Staff\Lookup\LevelField;

use App\Http\Controllers\Controller;
use App\Models\Lookup\Field;
use App\Repositories\Staff\Lookup\LevelField\FieldRepository;
use App\Tools\HttpResponse;
use App\Tools\JsonResponse;
use Illuminate\Http\Request;

class FieldController extends Controller
{
    protected $fieldRepository;

    public function __construct(FieldRepository $fieldRepository)
    {
        $this->fieldRepository = $fieldRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->expectsJson()) {
            return JsonResponse::successObject($this->fieldRepository->index());
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
     * @param  \App\Models\Lookup\Field $field
     * @return \Illuminate\Http\Response
     */
    public function show(Field $field)
    {
        if (request()->expectsJson()) {
            return JsonResponse::successObject($this->fieldRepository->show($field));
        } else {
            abort(HttpResponse::NOT_IMPLEMENTED);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lookup\Field $field
     * @return \Illuminate\Http\Response
     */
    public function edit(Field $field)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Lookup\Field $field
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Field $field)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lookup\Field $field
     * @return \Illuminate\Http\Response
     */
    public function destroy(Field $field)
    {
        //
    }
}
