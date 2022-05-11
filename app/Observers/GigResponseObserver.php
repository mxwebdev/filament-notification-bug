<?php

namespace App\Observers;

use App\Models\GigResponse;
use App\Mail\GigResponseRequest;
use Illuminate\Support\Facades\Mail;

class GigResponseObserver
{
    /**
     * Handle the GigResponse "created" event.
     *
     * @param  \App\Models\GigResponse  $gigResponse
     * @return void
     */
    public function created(GigResponse $gigResponse)
    {
        if($gigResponse->gig->creator->id != $gigResponse->user->id) {
            Mail::to($gigResponse->user->email)->send(new GigResponseRequest($gigResponse));
        }
    }

    /**
     * Handle the GigResponse "updated" event.
     *
     * @param  \App\Models\GigResponse  $gigResponse
     * @return void
     */
    public function updated(GigResponse $gigResponse)
    {
        //
    }

    /**
     * Handle the GigResponse "deleted" event.
     *
     * @param  \App\Models\GigResponse  $gigResponse
     * @return void
     */
    public function deleted(GigResponse $gigResponse)
    {
        //
    }

    /**
     * Handle the GigResponse "restored" event.
     *
     * @param  \App\Models\GigResponse  $gigResponse
     * @return void
     */
    public function restored(GigResponse $gigResponse)
    {
        //
    }

    /**
     * Handle the GigResponse "force deleted" event.
     *
     * @param  \App\Models\GigResponse  $gigResponse
     * @return void
     */
    public function forceDeleted(GigResponse $gigResponse)
    {
        //
    }
}
