<?php

namespace App\Http\Requests\General;

use Illuminate\Foundation\Http\FormRequest;

class DisplayPictureRequest extends FormRequest
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
            'file' => 'required|image|max:' . config('file.images.user.profile_picture.max_size', 200),
        ];
    }
}
