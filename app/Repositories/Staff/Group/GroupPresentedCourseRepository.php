<?php
/**
 * Created by PhpStorm.
 * User: Mohammad
 * Date: 9/15/2017
 * Time: 10:59 AM
 */

namespace App\Repositories\Staff\Group;


use App\Models\Education\Group\Group;
use App\Models\Education\Group\GroupPresentedCourse;
use App\Repositories\BaseRepository;
use App\Tools\Settings;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Input;

class GroupPresentedCourseRepository extends BaseRepository
{
    protected $fillable = [
        'presentation_id',
        'description',
    ];

    public function index(Group $group, $window_size = Settings::PAGINATION_GROUP_PRESENTED_COURSE_LIMIT)
    {
        return $this->load(
            $group->groupPresentedCourses()
                ->whereHas('presentation', function ($query) {
                    $query->whereHas('course', function ($query) {
                        $query->when(!is_null(Input::get('reference_name')), function ($query) {
                            $query->where('reference_name', 'like', '%' . Input::get('reference_name') . '%');
                        })->when(!is_null(Input::get('reference_code')), function ($query) {
                            $query->where('reference_code', 'like', '%' . Input::get('reference_code') . '%');
                        })->when(is_numeric(Input::get('multiplier')), function ($query) {
                            $query->where('multiplier', '=', Input::get('multiplier'));
                        })->when(!is_null(Input::get('title')), function ($query) {
                            $query->where('title', 'like', '%' . Input::get('title') . '%');
                        });
                    })->whereHas('teacher', function ($query) {
                        $query->whereHas('user', function ($query) {
                            $query->when(!is_null(Input::get('first_name')), function ($query) {
                                $query->where('first_name', 'like', '%' . Input::get('first_name') . '%');
                            })->when(!is_null(Input::get('surname')), function ($query) {
                                $query->where('surname', 'like', '%' . Input::get('surname') . '%');
                            })->when(!is_null(Input::get('national_code')), function ($query) {
                                $query->where('national_code', 'like', '%' . Input::get('national_code') . '%');
                            })->when(!is_null(Input::get('email')), function ($query) {
                                $query->where('email', 'like', '%' . Input::get('email') . '%');
                            });
                        })->when(!is_null(Input::get('mobile')), function ($query) {
                            $query->where('mobile', 'like', '%' . Input::get('mobile') . '%');
                        });
                    });

                })
        )->paginate($window_size);
    }

    public function store(array $data, Group $group)
    {
        return $this->load($group->groupPresentedCourses()->save($this->fill($data, new GroupPresentedCourse())));
    }

    public function show(GroupPresentedCourse $groupPresentedCourses)
    {
        return $this->load($groupPresentedCourses);
    }

    public function update(array $data, GroupPresentedCourse $groupPresentedCourses)
    {
        $this->fill($data, $groupPresentedCourses)->save();

        return $this->load($groupPresentedCourses);
    }

    public function destroy(GroupPresentedCourse $groupPresentedCourses)
    {
        return $groupPresentedCourses->delete();
    }

    /**
     * @param $object
     * @return Builder|Relation|GroupPresentedCourse
     */
    public function load($object)
    {
        if ($object instanceof Relation || $object instanceof Builder) {
            $object->with([
                'presentation.teacher.user',
                'presentation.course'
            ]);
        } elseif ($object instanceof GroupPresentedCourse) {
            $object->load([
                'presentation.teacher.user',
                'presentation.course'
            ]);
        }

        return $object;
    }
}