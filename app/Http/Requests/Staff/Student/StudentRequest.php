<?php

namespace App\Http\Requests\Staff\Student;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StudentRequest extends FormRequest
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

            'student_code' => 'string',
            'date_of_birth' => 'date',
            'phone' => 'required|max:20|string',
            'mobile' => 'string|max:20',
            'address' => 'string|max:255',

        ];
    }
}
