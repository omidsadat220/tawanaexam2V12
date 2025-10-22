<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class department extends Model
{
    //

    protected $guarded = [];

    public function subjects()
    {
        return $this->hasMany(DepartmentSubject::class, 'department_id');
    }

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }

    
}
