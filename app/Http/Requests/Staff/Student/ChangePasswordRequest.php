<?php

namespace App\Http\Requests\Staff\Student;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'password' => 'filled|same:password_confirm|between:6,255|string',
            'password_confirm' => 'filled|same:password|between:6,255|string',
        ];
    }
}
