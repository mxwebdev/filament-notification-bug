<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Song extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $casts = [
        'bpm' => 'integer',
    ];

    protected $with = ['placeholder'];

    public function registerMediaCollections(): void
    {
        //$disk = App::environment('production') ? 's3' : 'public';
        $disk = 's3';

        $this->addMediaCollection('placeholders')
            ->singleFile()
            ->useDisk($disk)
            ->acceptsMimeTypes(['application/pdf']);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function sets(): BelongsToMany
    {
        return $this->belongsToMany(Set::class)->withTimestamps();
    }

    public function files(): HasMany
    {
        return $this->hasMany(File::class);
    }

    public function placeholder(): HasOne
    {   
        return $this->hasOne(Media::class, 'model_id')
            ->where('model_type', 'App\Models\Song')
            ->where('collection_name', 'placeholders');
    }

    public function userFile(): HasOne
    {
        return $this->hasOne(File::class)
            ->whereHas('users', function (Builder $query) {
                $query->where('user_id', auth()->id());
            });
    }
}
