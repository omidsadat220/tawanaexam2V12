<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable = [
        'department_id',
        'subject_id',
        'exam_title',
        'start_time',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function subject()
    {
        return $this->belongsTo(DepartmentSubject::class, 'subject_id');
    }

    
}
