<?php

namespace App\Models;

use App\Enums\VoteType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vote extends Model
{

    protected $casts = [
        'type' => VoteType::class,
    ];


    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }
}
