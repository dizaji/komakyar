<?php

namespace App\Http\Requests;


use App\Tools\KomakyarHelper;
use Illuminate\Foundation\Http\FormRequest;

abstract class BaseRequest extends FormRequest
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
     * @param string $prefix
     * @return array
     */
    public function rules($prefix = '')
    {
        $this->registerCustomValidations();

        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
                return [];
            case 'POST':
                return KomakyarHelper::appendParentToArrayKeys($this->postRules($prefix), $prefix);
            case 'PUT':
            case 'PATCH':
                return KomakyarHelper::appendParentToArrayKeys($this->putRules($prefix), $prefix);
        }
    }

    /**
     * Get the validation rules that apply to the post request.
     *
     * @param string $prefix
     * @return array
     */
    public abstract function postRules($prefix = '');

    /**
     * Get the validation rules that apply to the put/patch request.
     *
     * @param string $prefix
     * @return array
     */
    public function putRules($prefix = '')
    {
        return $this->postRules($prefix);
    }

    /**
     * register custom validation rules.
     */
    public function registerCustomValidations()
    {

    }
}
