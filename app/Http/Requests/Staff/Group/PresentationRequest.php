<?php

namespace App\Http\Requests\Staff\Group;

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
            'group_id' => ['required', 'exists:education_groups,id',],
            'presentation_id' => ['required', 'exists:education_course_presentations,id',],
            'description' => ['nullable', 'string', 'max:65535',],
        ];
    }
    
    public function putRules($prefix = '')
    {
        $result =  parent::putRules($prefix);

        $result['group_id'] = ['filled', 'exists:education_groups,id',];
        $result['presentation_id'] = ['filled', 'exists:education_course_presentations,id',];

        return $result;
    }
}
