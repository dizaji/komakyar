<?php

namespace App\Http\Requests\Staff\Lookup\Course;

use App\Http\Requests\BaseRequest;

class CourseRequest extends BaseRequest
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
            'title' => ['required', 'string', 'max:255'],
            'multiplier' => ['required', 'integer', 'between:0,127'],
            'reference_name' => ['nullable', 'string', 'max:255'],
            'reference_code' => ['nullable', 'string', 'max:255']
        ];
    }
}
