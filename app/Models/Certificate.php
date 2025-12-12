<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $guarded = [];

    public function result() {
        return $this->belongsTo(FinalExamResult::class, 'final_result_id');
    }
}
