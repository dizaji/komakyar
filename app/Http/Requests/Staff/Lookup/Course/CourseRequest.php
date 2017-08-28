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
        $result = [
            'level_field_id' => 'required|exists:level_fields,id',
            'title' => 'required|string|max:255',
            'course_source_id' => 'nullable|not_present_with:source',
            'source' => 'nullable|not_present_with:course_source_id',
            'academic_year_id' => 'required|exists:academic_years,id',
            'multiplier' => 'required|integer|between:0,127',
        ];
        if($this->exists('source')){
            $sourceRequest = new CourseSourceRequest($this->all()['course_source']);
            $sourceRequest->setMethod($this->method());

            $result = array_merge($result,$sourceRequest->rules('source'));
        }
        
        return $result;
    }
}
