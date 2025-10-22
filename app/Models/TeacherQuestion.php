<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeacherQuestion extends Model
{

    protected $guarded = [];


    public function subject()
    {
        return $this->belongsTo(DepartmentSubject::class, 'subject_id');
    }
}
