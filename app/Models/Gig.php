<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Relations\HasManyThrough;
// use Staudenmeir\EloquentHasManyDeep\HasManyDeep;

class Gig extends Model
{

    use HasFactory;
    use SoftDeletes;
    // use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

    const STATUS_OPEN = 0;
    const STATUS_CONFIRMED = 1;

    const STATUS = [
        self::STATUS_OPEN => 'Open',
        self::STATUS_CONFIRMED => 'Confirmed',
    ];

    protected $casts = [
        'gig_start' => 'date:Y-m-d',
        'gig_end' => 'date:Y-m-d',
        'fee' => 'integer',
        'status' => 'integer',
    ];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // public function sets(): HasMany
    // {
    //     return $this->hasMany(Set::class)->orderBy('position');
    // }

    // public function songs(): HasManyDeep
    // {
    //     return $this->hasManyDeep(Song::class, [Set::class, 'set_song']);
    // }

    public function gigResponses(): HasMany
    {
        return $this->hasMany(GigResponse::class)->with('user');
    }

    // public function users(): HasManyThrough
    // {
    //     return $this->hasManyDeep(User::class, [GigResponse::class], [null, 'id', 'id'], [null, 'gig_id', 'user_id']);
    // }
}
