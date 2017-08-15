<?php
/**
 * Created by PhpStorm.
 * User: Mohammad
 * Date: 8/14/2017
 * Time: 10:38 PM
 */

namespace App\Repositories\Staff\User;


use App\User;

class UserRepository
{
    protected $fillable = [
        'first_name',
        'surname',
        'email',
        'national_code',
        'description',
    ];

    public function fill(array $array, $object = null)
    {
        if(is_null($object)){
            $object = (new User());
        }

        $object->fillable($this->fillable)->fill($array);
        if(isset($array['password'])){
            $object->password = bcrypt($array['password']);
        }

        return $object;
    }
}