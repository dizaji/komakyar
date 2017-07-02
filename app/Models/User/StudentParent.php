<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class StudentParent extends Model
{
    protected $table = 'user_parents';

    public function user()
    {
        $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function student()
    {
        $this->belongsTo('App\Models\User\Student', 'student_id', 'id');
    }
}
