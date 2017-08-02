<?php
/**
 * Created by PhpStorm.
 * User: Mohammad
 * Date: 24/07/2017
 * Time: 12:17 AM
 */

namespace App\Repositories\Staff;


use App\Models\Education\Group\Group;
use App\Tools\Settings;
use Illuminate\Database\Eloquent\Builder;

class GroupRepository
{
    public function index($window_size = Settings::PAGINATION_LIMIT_STAFF)
    {
        $group_query = Group::query();
        return $this->load($group_query)->paginate($window_size);
    }

    public function load($group)
    {
        $group_student_query = function ($query) {
            $query->limit(30);
            $query->with('student.user');
        };

        if($group instanceof Group){
            $group->load([
                'levelField.level',
                'levelField.field',
                'groupStudents' => $group_student_query
            ]);
        } elseif ($group instanceof Builder) {
            $group->with([
                'levelField.level',
                'levelField.field',
                'groupStudents' => $group_student_query
            ]);
        } else {
            foreach ($group as $index=>$value){
                $group[$index] = $this->load($value);
            }
        }

        return $group;
    }

    protected function getLoadArray()
    {


        return ;
    }
}