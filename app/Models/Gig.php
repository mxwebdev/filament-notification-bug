<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Staudenmeir\EloquentHasManyDeep\HasManyDeep;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Gig extends Model implements HasMedia
{

    use HasFactory;
    use SoftDeletes;
    use InteractsWithMedia;
    use LogsActivity;
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

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

    public function registerMediaCollections(): void
    {
        $disk = 's3';

        $this->addMediaCollection('title_pages')
            ->singleFile()
            ->useDisk($disk)
            ->acceptsMimeTypes(['application/pdf']);
    }

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

    public function sets(): HasMany
    {
        return $this->hasMany(Set::class)->orderBy('position');
    }

    public function songs(): HasManyDeep
    {
        return $this->hasManyDeep(Song::class, [Set::class, 'set_song'])
            ->withIntermediate(Set::class, ['position'])
            ->withPivot('set_song', ['position'])
            ->orderBy('__set__position', 'ASC')
            ->orderBy('__set_song__position', 'ASC')
            ->with('userFile');
    }

    public function gigResponses(): HasMany
    {
        return $this->hasMany(GigResponse::class)->with('user');
    }

    public function titlePage(): HasOne
    {   
        return $this->hasOne(Media::class, 'model_id')
            ->where('model_type', 'App\Models\Gig')
            ->where('collection_name', 'title_pages');
    }

    // public function userFiles(): HasManyDeep
    // {
    //     return $this->hasManyDeep(File::class, [Set::class, 'set_song', Song::class])
    //         ->withIntermediate(Set::class, ['position'])
    //         ->withPivot('set_song', ['position'])
    //         ->orderBy('__set__position', 'ASC')
    //         ->orderBy('__set_song__position', 'ASC')
    //         ->whereHas('users', function (Builder $query) {
    //             $query->where('user_id', auth()->id());
    //         });
    // }
}
