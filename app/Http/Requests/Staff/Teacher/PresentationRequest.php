<?php

namespace App\Http\Requests\Staff\Teacher;

use App\Http\Requests\BaseRequest;

class PresentationRequest extends BaseRequest
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
            'course_id' => ['required', 'exists:education_courses,id'],
            'description' => ['nullable', 'string', 'max:65535'],
        ];
    }
}
