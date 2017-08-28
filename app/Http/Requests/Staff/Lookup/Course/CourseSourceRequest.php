<?php

namespace App\Http\Requests\Staff\Lookup\Course;

use App\Http\Requests\BaseRequest;

class CourseSourceRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the post request.
     *
     * @param string $prefix
     * @return array
     */
    public function postRules($prefix = '')
    {
        return [
            'reference_name' => 'required|string|max:255',
            'reference_code' => 'nullable|string|max:255'
        ];
    }
}
