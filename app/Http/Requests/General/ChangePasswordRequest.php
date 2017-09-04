<?php
/**
 * Created by PhpStorm.
 * User: am
 * Date: 9/3/2017
 * Time: 9:39 PM
 */

namespace App\Http\Requests\General;


use App\Http\Requests\BaseRequest;

class ChangePasswordRequest extends BaseRequest
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
            'password' => ['filled', 'same:password_confirm', 'between:6,255', 'string'],
            'password_confirm' => ['filled', 'same:password', 'between:6,255', 'string'],
        ];
    }
}