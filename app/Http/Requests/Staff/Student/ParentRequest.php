<?php

namespace App\Http\Requests\Staff\Student;

use App\Models\User\StudentParent;
use App\Tools\KomakyarHelper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ParentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
                return [];
            case 'POST':
                return [
                    'user.first_name' => 'required|string|between:3,255',
                    'user.surname' => 'required|string|between:3,255',
                    'user.password' => 'required|same:user.password_confirm|between:6,255|string',
                    'user.password_confirm' => 'required',
                    'user.email' => [
                        'string',
                        'email',
                        'max:255',
                        Rule::unique('users','email')->whereNotNull('users.email')
                    ],
                    'user.national_code' => 'required|unique:users,national_code',
                    'user.description' => 'string|max:65535',

                    'relative' => 'required|in:' . KomakyarHelper::stringifyArrayForValidation(StudentParent::RELATIVES),
                    'mobile_1' => 'required|max:20|string',
                    'mobile_2' => 'max:20|string',
                ];
            case 'PUT':
            case 'PATCH':
            return [
                'user.first_name' => 'required|string|between:3,255',
                'user.surname' => 'required|string|between:3,255',
                'user.password' => 'filled|same:user.password_confirm|between:6,255|string',
                'user.password_confirm' => 'filled|same:user.password_confirm|between:6,255|string',
                'user.email' => [
                    'email',
                    'max:255',
                    Rule::unique('users','email')->whereNotNull('users.email')->ignore($this->parent->user->id)
                ],
                'user.national_code' => 'required|unique:users,national_code,' . $this->parent->user->id,
                'user.description' => 'max:65535',

                'relative' => 'required|in:' . KomakyarHelper::stringifyArrayForValidation(StudentParent::RELATIVES),
                'mobile_1' => 'required|max:20',
                'mobile_2' => 'max:20',
            ];
        }


    }
}
