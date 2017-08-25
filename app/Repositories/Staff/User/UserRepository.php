<?php
/**
 * Created by PhpStorm.
 * User: Mohammad
 * Date: 8/14/2017
 * Time: 10:38 PM
 */

namespace App\Repositories\Staff\User;


use App\Repositories\BaseRepository;
use App\Tools\FileHelper;

class UserRepository extends BaseRepository
{
    protected $fillable = [
        'first_name',
        'surname',
        'email',
        'national_code',
        'description',
    ];

    public function fill(array $array, $object = null, $fillable = [])
    {
        parent::fill($array, $object, $fillable);
        if(isset($array['password'])){
            $object->password = bcrypt($array['password']);
        }

        return $object;
    }

    public function load($user)
    {
        if($user instanceof $user){
            $user->profile_picture = FileHelper::downloadFileURL($user->profile_picture);
        }
    }
}