<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Gig;
use Livewire\Component;
use App\Models\GigResponse;

class UpcomingGigs extends Component
{
    public $gigs;
    public Gig $editing;
    public $invitedUsers = [];
    public $upcomingGigsCount;

    public $showSlideOver = false;

    protected $listeners = ['openCreateGigSlideOver' => 'openSlideOver'];

    public function rules() {
        return [
            'editing.name' => 'required|string',
            'editing.location' => 'required|string',
            'editing.gig_start' => 'required|date',
            'editing.fee' => 'nullable|integer|min:0',
            'editing.status' => 'required|integer|in:'.collect(Gig::STATUS)->keys()->implode(','),
        ];
    }

    public function mount()
    {
        $this->editing = $this->makeBlankGig();
    }

    public function openSlideOver()
    {
        $this->showSlideOver = true;
    }

    public function closeSlideOver()
    {
        $this->showSlideOver = false;
        $this->editing = $this->makeBlankGig();
        $this->invitedUsers = [];
    }

    public function makeBlankGig()
    {
        return Gig::make([
            'status' => 0,
            'gig_start' => Carbon::now()->format('Y-m-d'),
        ]);
    }

    public function toggleInvitedUser($user_id)
    {
        if(!in_array($user_id, $this->invitedUsers)) {
            $this->invitedUsers[] = $user_id;
        }
        else if (($key = array_search($user_id, $this->invitedUsers)) !== false) {
                unset($this->invitedUsers[$key]);
        }
    }

    public function save()
    {   
        $this->validate();

        $this->editing->team_id = auth()->user()->currentTeam->id;
        $this->editing->created_by = auth()->id();
        $this->editing->save();

        foreach ($this->invitedUsers as $user_id) {

            if ($this->editing->creator->id === $user_id) {
                $this->editing->gigResponses()->create([
                    'user_id' => $user_id, 
                    'status' => GigResponse::STATUS_ACCEPTED,
                    'responded_at' => Carbon::now(),
                ]);
            }
            else {
                $this->editing->gigResponses()->create(['user_id' => $user_id]);
            }

        }

        $this->closeSlideOver();
    }
    
    public function render()
    {
        $this->gigs = auth()->user()->currentTeam->gigs()
            ->whereDate('gig_start', '>=', Carbon::now())
            ->orderBy('gig_start')
            ->with('creator', 'gigResponses')
            ->limit(5)
            ->get();

        $this->upcomingGigsCount = auth()->user()->currentTeam->gigs()
            ->whereDate('gig_start', '>=', Carbon::now())
            ->count();
        
        return view('livewire.upcoming-gigs');
    }
}
