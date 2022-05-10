<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GigResponse extends Model
{
    use HasFactory;
    use SoftDeletes;

    const STATUS_PENDING = 0;
    const STATUS_ACCEPTED = 1;
    const STATUS_DECLINED = 2;
    const STATUS_TENTATIVE = 3;

    protected $casts = [
        'status' => 'integer',
        'responseTime' => 'immutable_datetime',
    ];

    public function gig(): BelongsTo
    {
        return $this->belongsTo(Gig::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
