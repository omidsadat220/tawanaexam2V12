<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SetClassStudent extends Model
{
    //
    protected $guarded = [];

     public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
