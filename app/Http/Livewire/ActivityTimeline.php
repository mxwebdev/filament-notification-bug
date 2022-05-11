<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Spatie\Activitylog\Models\Activity;

class ActivityTimeline extends Component
{
    public $activities;

    /**
     * The component's listeners.
     *
     * @var array
     */
    protected $listeners = [
        'refresh-activity-timeline' => '$refresh',
    ];

    public function render()
    {
        $this->activities = Activity::where('log_name', auth()->user()->currentTeam->id)
            ->where(function ($q) {
                $q->where('description', 'gig_created')->orWhere('description', 'gig_response_updated');
            })
            ->orderBy('created_at', 'desc')
            ->limit(7)
            ->get();

        return view('livewire.activity-timeline');
    }
}
