<?php

namespace App\Listeners;

use App\Mail\GigResponseRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendGigResponseRequestEmail
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\GigCreated  $event
     * @return void
     */
    public function handle($event)
    {
        $gig = $event->gig;

        foreach ($gig->gigResponses as $gigResponse) {
            if($gig->creator->id != $gigResponse->user->id) {
                Mail::to($gigResponse->user->email)->send(new GigResponseRequest($gigResponse));
            }
        }

    }
}
