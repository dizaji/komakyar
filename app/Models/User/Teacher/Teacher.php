<?php

namespace App\Models\User\Teacher;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $table = 'user_teachers';

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function Presentations()
    {
        return $this->hasMany('App\Models\Education\Course\Presentation', 'teacher_id', 'id');
    }

    public function gradeTypes()
    {
        return $this->hasMany('App\Models\User\Teacher\GradeType', 'teacher_id', 'id');
    }

    const DEGREE_BELOW_DIPLOMA = 'below diploma';
    const DEGREE_DIPLOMA = 'diploma';
    const DEGREE_ABOVE_DIPLOMA = 'above diploma';
    const DEGREE_BSC = 'bsc';
    const DEGREE_MSC = 'msc';
    const DEGREE_PHD = 'phd';
    const DEGREE_OTHER = 'other';
    const DEGREES = [
        self::DEGREE_BELOW_DIPLOMA,
        self::DEGREE_DIPLOMA,
        self::DEGREE_ABOVE_DIPLOMA,
        self::DEGREE_BSC,
        self::DEGREE_MSC,
        self::DEGREE_PHD,
        self::DEGREE_OTHER,
    ];
}
