<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class StudentParent extends Model
{
    protected $table = 'user_parents';

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function student()
    {
        return $this->belongsTo('App\Models\User\Student', 'student_id', 'id');
    }

    const RELATIVE_FATHER = 'father';
    const RELATIVE_MOTHER = 'mother';
    const RELATIVE_OTHER = 'other';
    const RELATIVES = [
        self::RELATIVE_FATHER,
        self::RELATIVE_MOTHER,
        self::RELATIVE_OTHER,
    ];
}
