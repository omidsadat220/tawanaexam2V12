<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AddExam extends Model
{
   protected $guarded = [];

   public function user()
   {
       return $this->belongsTo(User::class);
   }

   public function department()
   {
       return $this->belongsTo(Department::class);
   }

    public function subject()
    {
         return $this->belongsTo(DepartmentSubject::class);
    }
}
