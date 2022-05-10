<?php

namespace App\Events;

use App\Models\Gig;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class GigCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The gig instance.
     * 
     * @var \App\Models\Gig 
     */
    public $gig;

    /**
     * Create a new event instance.
     *
     * @param \App\Models\Gig $gig
     * @return void
     */
    public function __construct(Gig $gig)
    {
        $this->gig = $gig;
    }

}
