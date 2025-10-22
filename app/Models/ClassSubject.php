<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassSubject extends Model
{
    protected $guarded = [];

    public function classcategory()
{
    return $this->belongsTo(ClassCategory::class, 'class_category_id', 'id');
}

public function category()
{
    return $this->belongsTo(ClassCategory::class, 'class_category_id');
}

   

       
}
