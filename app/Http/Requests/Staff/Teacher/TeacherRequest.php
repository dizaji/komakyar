<?php

namespace App\Http\Requests\Staff\Teacher;

use App\Http\Requests\BaseRequest;
use App\Http\Requests\Staff\User\UserRequest;

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
//                'student_code' => 'nullable|string',
////                'date_of_birth' => 'required|date',
//                'phone' => 'required|max:20|string',
//                'mobile' => 'nullable|string|max:20',
//                'address' => 'nullable|string|max:255',

            ],
            $userRequest->rules('user')
        );
    }
}