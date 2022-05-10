<?php

namespace App\Mail;

use App\Models\GigResponse;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\URL;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class GigResponseRequest extends Mailable
{
    use Queueable, SerializesModels;

    public $gigResponse;

    /**
     * Create a new message instance.
     * 
     * @param \App\Models\GigResponse $gigResponse
     * @return void
     */
    public function __construct(GigResponse $gigResponse)
    {
        $this->gigResponse = $gigResponse;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.gig-response-request', [
                'acceptUrl' => URL::signedRoute('gig-responses.accept', ['gigResponse' => $this->gigResponse]),
                'declineUrl' => URL::signedRoute('gig-responses.decline', ['gigResponse' => $this->gigResponse])
            ])
            ->subject('New gig invitation for ' . $this->gigResponse->gig->team->name . ' on ' . $this->gigResponse->gig->gig_start->toFormattedDateString());
    }
}
