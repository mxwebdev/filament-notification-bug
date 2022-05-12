<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
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
    use LogsActivity;
    // use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

    const STATUS_OPEN = 0;
    const STATUS_CONFIRMED = 1;

    const STATUS = [
        self::STATUS_OPEN => 'Open',
        self::STATUS_CONFIRMED => 'Confirmed',
    ];

    const STATUS_COLOR = [
        self::STATUS_OPEN => 'yellow',
        self::STATUS_CONFIRMED => 'green',
    ];

    protected $casts = [
        'gig_start' => 'date:Y-m-d',
        'gig_end' => 'date:Y-m-d',
        'fee' => 'integer',
        'status' => 'integer',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->setDescriptionForEvent(fn(string $eventName) => "gig_{$eventName}")
            ->useLogName($this->team->id);
    }

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
