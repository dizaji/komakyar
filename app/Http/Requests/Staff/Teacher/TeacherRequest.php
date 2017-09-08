<?php

namespace App\Http\Requests\Staff\Teacher;

use App\Http\Requests\BaseRequest;
use App\Http\Requests\Staff\User\UserRequest;
use App\Models\User\Teacher\Teacher;

class TeacherRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the post request.
     *
     * @return array
     */
    public function postRules($prefix = '')
    {
        $userRequest = new UserRequest($this->user);
        $userRequest->setMethod($this->method());
        if($this->method() == 'PUT') $userRequest->setUser($this->teacher->user);

        return array_merge(
            [
                'degree' => ['nullable', 'in:' . implode(',', Teacher::DEGREES)],
                'mobile' => ['nullable', 'string', 'max:20'],
                'field_of_study' => ['nullable', 'string', 'max:255'],
                'description' => ['nullable', 'string', 'max:255'],
            ],
            $userRequest->rules('user')
        );
    }
}