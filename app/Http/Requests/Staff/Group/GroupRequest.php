<?php

namespace App\Http\Requests\Staff\Group;

use App\Http\Requests\BaseRequest;

class GroupRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the post request.
     *
     * @return array
     */
    public function postRules()
    {
        return [
            'title' => 'required|alpha_number_spaces',
            'academic_year_id' => 'required|exists:academic_years,id',
            'level_field_id' => 'required|exists:level_fields,id'
        ];
    }
}
