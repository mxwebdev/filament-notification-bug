<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Set extends Model
{
    use HasFactory;

    protected $casts = [
        'position' => 'integer',
    ];

    protected $with = [
        'songs',
    ];

    public function gig(): BelongsTo
    {
        return $this->belongsTo(Gig::class);
    }

    public function songs(): BelongsToMany
    {
        return $this->belongsToMany(Song::class)->withTimestamps()->orderBy('position');
    }
}
