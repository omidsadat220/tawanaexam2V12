<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SelectTeacher extends Model
{
    protected $guarded = [];

    public function student(){
        return $this->belongsTo(User::class, 'student_id');
    }

    public function teacher(){
        return $this->belongsTo(User::class, 'teacher_id');
    }
}
