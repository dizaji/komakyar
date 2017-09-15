<?php
/**
 * Created by PhpStorm.
 * User: Mohammad
 * Date: 9/15/2017
 * Time: 10:59 AM
 */

namespace App\Repositories\Staff\Group;


use App\Models\Education\Group\Group;
use App\Models\Education\Group\GroupPresentedCourses;
use App\Repositories\BaseRepository;
use App\Tools\Settings;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;

class GroupPresentedCourseRepository extends BaseRepository
{
    protected $fillable = [
        'presentation_id',
        'description',
    ];

    public function index(Group $group, $window_size = Settings::PAGINATION_GROUP_PRESENTED_COURSE_LIMIT)
    {
        return $this->load($group->groupPresentedCourses())->paginate($window_size);
    }

    public function store(array $data, Group $group)
    {
        return $this->load($group->groupPresentedCourses()->save($this->fill($data, new GroupPresentedCourses())));
    }

    public function show(GroupPresentedCourses $groupPresentedCourses)
    {
        return $this->load($groupPresentedCourses);
    }

    public function update(array $data, GroupPresentedCourses $groupPresentedCourses)
    {
        $this->fill($data, $groupPresentedCourses)->save();

        return $this->load($groupPresentedCourses);
    }

    public function destroy(GroupPresentedCourses $groupPresentedCourses)
    {
        return $groupPresentedCourses->delete();
    }

    /**
     * @param $object
     * @return Builder|Relation|GroupPresentedCourses
     */
    public function load($object)
    {
        return $object;
    }
}