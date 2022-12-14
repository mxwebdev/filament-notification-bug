<?php

namespace App\Models;

use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class File extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $with = ['owner', 'users'];

    public function registerMediaCollections(): void
    {
        //$disk = App::environment('production') ? 's3' : 'public';
        $disk = 's3';

        $this->addMediaCollection('sheets')
            ->singleFile()
            ->useDisk($disk)
            ->acceptsMimeTypes(['image/jpg', 'image/jpeg', 'image/png', 'application/pdf']);
    }

    public function song(): BelongsTo
    {
        return $this->belongsTo(Song::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function getPreview()
    {
        if (!is_null($this->getFirstMedia('sheets'))) {
            $url = $this->getFirstMedia('sheets')->getUrl();
            $mimeType = $this->getFirstMedia('sheets')->mime_type;
        
            if (Str::is('image/*', $mimeType)) {
                return "<img class='object-contain max-h-96 w-full' src=" . $url . " alt=" . $url . ">";
            }
            elseif ($mimeType == 'application/pdf') {
                return "<embed src=" . $url . " class='w-full' style='height: 24rem' frameborder='0'>";
            }
        }
    }
}
