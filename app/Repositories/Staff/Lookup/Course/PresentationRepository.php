<?php
/**
 * Created by PhpStorm.
 * User: Mohammad
 * Date: 9/15/2017
 * Time: 12:03 PM
 */

namespace App\Repositories\Staff\Lookup\Course;


use App\Models\Education\Course\Presentation;
use App\Repositories\BaseRepository;
use App\Tools\Settings;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Input;

class PresentationRepository extends BaseRepository
{

    public function index($window_size = Settings::PAGINATION_LOOKUP_COURSE_PRESENTED_COURSE_LIMIT)
    {
        $this->load(Presentation::query()->whereHas('course', function ($query) {
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
            });
        }))->paginate($window_size);
    }

    public function show(Presentation $presentation)
    {
        $this->load($presentation);
    }

    /**
     * @param Relation|Builder|Presentation $object
     * @return Relation|Builder|Presentation
     */
    public function load($object)
    {
        if ($object instanceof Relation || $object instanceof Builder) {
            $object->with(['teacher', 'course']);
        } elseif ($object instanceof Presentation) {
            $object->load(['teacher', 'course']);
        }

        return $object;
    }
}