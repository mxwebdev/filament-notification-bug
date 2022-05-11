<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HasTeamPhoto
{
    /**
     * Update the team photo.
     *
     * @param  \Illuminate\Http\UploadedFile  $photo
     * @return void
     */
    public function updateTeamPhoto(UploadedFile $photo)
    {
        tap($this->team_photo_path, function ($previous) use ($photo) {
            $this->forceFill([
                'team_photo_path' => $photo->storePublicly(
                    'team-photos', ['disk' => $this->teamPhotoDisk()]
                ),
            ])->save();

            if ($previous) {
                Storage::disk($this->teamPhotoDisk())->delete($previous);
            }
        });
    }

    /**
     * Delete the team photo.
     *
     * @return void
     */
    public function deleteTeamPhoto()
    {
        // if (! Features::managesTeamPhotos()) {
        //     return;
        // }

        if (is_null($this->team_photo_path)) {
            return;
        }

        Storage::disk($this->teamPhotoDisk())->delete($this->team_photo_path);

        $this->forceFill([
            'team_photo_path' => null,
        ])->save();
    }

    /**
     * Get the URL to the team photo.
     *
     * @return string
     */
    public function getTeamPhotoUrlAttribute()
    {
        return $this->team_photo_path
                    ? Storage::disk($this->teamPhotoDisk())->url($this->team_photo_path)
                    : $this->defaultTeamPhotoUrl();
    }

    /**
     * Get the default team photo URL if no team photo has been uploaded.
     *
     * @return string
     */
    protected function defaultTeamPhotoUrl()
    {
        $name = trim(collect(explode(' ', $this->name))->map(function ($segment) {
            return mb_substr($segment, 0, 1);
        })->join(' '));

        return 'https://ui-avatars.com/api/?name='.urlencode($name).'&color=7F9CF5&background=EBF4FF';
    }

    /**
     * Get the disk that team photos should be stored on.
     *
     * @return string
     */
    protected function teamPhotoDisk()
    {
        return isset($_ENV['VAPOR_ARTIFACT_NAME']) ? 's3' : config('jetstream.team_photo_disk', 'public');
    }
}
