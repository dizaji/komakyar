<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = 'user_staffs';

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function dailyPrograms()
    {
        return $this->hasMany('App\Models\Education\Program\DailyProgram', 'staff_id', 'id');
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
