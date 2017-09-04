<?php
/**
 * Created by PhpStorm.
 * User: am
 * Date: 9/3/2017
 * Time: 9:39 PM
 */

namespace App\Http\Requests\Staff\Teacher;


use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
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