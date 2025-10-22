<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class qestion extends Model
{
    protected $guarded = [];

     public function subject()
    {
        return $this->belongsTo(DepartmentSubject::class, 'subject_id');
    }

//     public function user()
//    {
//        return $this->belongsTo(User::class , 'user_id');
//    }

     public function exam()
   {
       return $this->belongsTo(Exam::class , 'exam_id');
   }
}
