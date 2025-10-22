<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class classcategory extends Model
{
    protected $guarded = [];

public function classSubjects()
{
    return $this->hasMany(ClassSubject::class, 'class_category_id', 'id');
}

// ClassSubject.php

}
