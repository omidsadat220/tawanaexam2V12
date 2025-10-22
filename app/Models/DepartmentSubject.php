<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DepartmentSubject extends Model
{
    //

    protected $fillable = ['department_id', 'subject_name'];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function exams()
    {
        return $this->hasMany(Exam::class, 'subject_id');
    }

    

    
}
