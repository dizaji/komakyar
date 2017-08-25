<?php

namespace App\Http\Requests\Staff\Student;

use App\Http\Requests\BaseRequest;
use App\Http\Requests\Staff\User\UserRequest;
use App\Models\User\StudentParent;

class ParentRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the post request.
     *
     * @param string $prefix
     * @return array
     */
    public function postRules($prefix = '')
    {
        $userRequest = new UserRequest($this->user);
        $userRequest->setMethod($this->method());
        if($this->method() == 'PUT') $userRequest->setUser($this->parent->user);

        return array_merge(
            [
                'relative' => 'required|in:' . implode(',', StudentParent::RELATIVES),
                'mobile_1' => 'required|max:20',
                'mobile_2' => 'nullable|string|max:20',

            ],
            $userRequest->rules('user')
        );
    }
}
