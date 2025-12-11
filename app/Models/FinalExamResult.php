<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinalExamResult extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function certificate() {
        return $this->hasOne(Certificate::class, 'final_result_id');
    }
}
