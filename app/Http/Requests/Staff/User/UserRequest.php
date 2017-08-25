<?php
/**
 * Created by PhpStorm.
 * User: Mohammad
 * Date: 8/25/2017
 * Time: 11:47 AM
 */

namespace App\Http\Requests\Staff\User;


use App\Http\Requests\BaseRequest;
use App\Tools\KomakyarHelper;
use Illuminate\Validation\Rule;

class UserRequest extends BaseRequest
{
    protected $user;

    /**
     * Get the validation rules that apply to the post request.
     *
     * @return array
     */
    public function postRules($prefix = '')
    {
        $result = [
            'first_name' => 'required|string|between:3,255',
            'surname' => 'required|string|between:3,255',
            'password' => 'required|between:6,255|string|same:' . KomakyarHelper::appendParentAndDot('password_confirm', $prefix),
            'password_confirm' => 'required|between:6,255|string|same:' . KomakyarHelper::appendParentAndDot('password', $prefix),
            'email' => [
                'nullable',
                'string',
                'email',
                'max:255',
                'required_without:' . KomakyarHelper::appendParentAndDot('national_code', $prefix),
                Rule::unique('users', 'email')->whereNotNull('users.email')
            ],
            'national_code' => 'unique:users,national_code|required_without:' . KomakyarHelper::appendParentAndDot('email', $prefix),
            'description' => 'nullable|string|max:65535',
        ];

        return $result;
    }

    public function putRules($prefix = '')
    {
        $result = [
            'first_name' => 'required|string|between:3,255',
            'surname' => 'required|string|between:3,255',
            'password' => 'filled|between:6,255|string|same:' . KomakyarHelper::appendParentAndDot('password_confirm', $prefix),
            'password_confirm' => 'filled|between:6,255|string|same:' . KomakyarHelper::appendParentAndDot('password', $prefix),
            'email' => [
                'nullable',
                'string',
                'email',
                'max:255',
                'required_without:' . KomakyarHelper::appendParentAndDot('national_code', $prefix),
                Rule::unique('users', 'email')->whereNotNull('users.email')->ignore($this->user->id)
            ],
            'national_code' => 'unique:users,national_code,' . $this->user->id . '|required_without:' . KomakyarHelper::appendParentAndDot('email', $prefix),
            'description' => 'nullable|string|max:65535',
        ];

        return $result;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }
}