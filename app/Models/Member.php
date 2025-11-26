<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Member extends Model
{

    use SoftDeletes;

    protected $casts = [
        'terms' => 'array',
    ];

    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }
}
