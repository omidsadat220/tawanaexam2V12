<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Verifytoken extends Model
{
    protected $fillable = ['email', 'token', 'is_active', 'expires_at'];

    protected $casts = [
        'is_active' => 'boolean',
        'expires_at' => 'datetime',
    ];

    public function isExpired()
    {
        return $this->expires_at && $this->expires_at->isPast();
    }
}
