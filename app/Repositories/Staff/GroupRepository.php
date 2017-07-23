<?php
/**
 * Created by PhpStorm.
 * User: Mohammad
 * Date: 24/07/2017
 * Time: 12:17 AM
 */

namespace App\Repositories\Staff;


use App\Models\Education\Group\Group;

class GroupRepository
{
    protected function getLoadArray()
    {
        return [
            'levelField.level',
            'levelField.field',
            'groupStudents' => function ($query) {
                $query->limit(30);
                $query->with('student.user');
            }
        ];
    }

    public function indexWithData()
    {
        return Group::with($this->getLoadArray())->paginate(5);
    }
}