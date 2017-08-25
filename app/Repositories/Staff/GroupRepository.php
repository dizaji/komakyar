<?php
/**
 * Created by PhpStorm.
 * User: Mohammad
 * Date: 24/07/2017
 * Time: 12:17 AM
 */

namespace App\Repositories\Staff;


use App\Http\Requests\Staff\Group\GroupRequest;
use App\Models\Education\Group\Group;
use App\Repositories\BaseRepository;
use App\Tools\Settings;
use Illuminate\Database\Eloquent\Builder;

class GroupRepository extends BaseRepository
{
    protected $fillable = [
        'title',
        'academic_year_id',
        'level_field_id',
    ];

    public function index($window_size = Settings::GROUP_LIMIT)
    {
        $group_query = Group::query();
        return $this->load($group_query)->paginate($window_size);
    }

    public function store(GroupRequest $request)
    {
        $group = $this->fill($request->all(), new Group());
        $group->save();

        return $this->load($group);
    }

    public function load($object)
    {
        $group_student_query = function ($query) {
            $query->limit(30);
            $query->with('student.user');
        };

        if($object instanceof Group){
            $object->load([
                'levelField.level',
                'levelField.field',
                'groupStudents' => $group_student_query
            ]);
        } elseif ($object instanceof Builder) {
            $object->with([
                'levelField.level',
                'levelField.field',
                'groupStudents' => $group_student_query
            ]);
        } else {
            foreach ($object as $index=> $value){
                $object[$index] = $this->load($value);
            }
        }

        return $object;
    }
}