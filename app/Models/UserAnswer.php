<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{
    //
    protected $guarded = [];
     // Relations
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function exam() {
        return $this->belongsTo(Exam::class);
    }

    public function question()
{
    return $this->belongsTo(\App\Models\NewQuestion::class, 'question_id');
}


    public function department() {
        return $this->belongsTo(Department::class);
    }

    public function uni() {
        return $this->belongsTo(Category::class, 'uni_id'); // assuming Category is your uni model
    }
}
