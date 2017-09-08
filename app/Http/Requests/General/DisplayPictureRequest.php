<?php

namespace App\Http\Requests\General;

use App\Http\Requests\BaseRequest;

class DisplayPictureRequest extends BaseRequest
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
            'file' => 'required|image|max:' . config('file.images.user.profile_picture.max_size', 200),
        ];
    }
}
