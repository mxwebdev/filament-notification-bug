<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Gig;
use Livewire\Component;
use App\Models\GigResponse;

class GigsEdit extends Component
{
    public Gig $gig;
    public $invitedUsers = [];
    public $upcomingGigsCount;

    public $showSlideOver = false;

    protected $listeners = ['openEditGigSlideOver' => 'openSlideOver'];

    public function rules() {
        return [
            'gig.name' => 'required|string',
            'gig.location' => 'required|string',
            'gig.gig_start' => 'required|date',
            'gig.fee' => 'nullable|integer|min:0',
            'gig.status' => 'required|integer|in:'.collect(Gig::STATUS)->keys()->implode(','),
        ];
    }

    public function mount()
    {
        $this->invitedUsers = $this->gig->gigResponses->pluck('user_id')->toArray();
    }

    public function openSlideOver()
    {
        $this->showSlideOver = true;
    }

    public function closeSlideOver()
    {
        $this->showSlideOver = false;
        $this->invitedUsers = [];
    }

    public function toggleInvitedUser($user_id)
    {
        if(!in_array($user_id, $this->invitedUsers)) {
            $this->invitedUsers[] = $user_id;
        }
        // else if (($key = array_search($user_id, $this->invitedUsers)) !== false) {
        //         unset($this->invitedUsers[$key]);
        // }
    }

    public function save()
    {   
        $this->validate();

        $this->gig->team_id = auth()->user()->currentTeam->id;
        $this->gig->created_by = auth()->id();
        $this->gig->save();

        foreach ($this->invitedUsers as $user_id) {

            if (auth()->user()->id === $user_id) {
                $this->gig->gigResponses()->firstOrCreate(['user_id' => $user_id], [
                    'user_id' => $user_id, 
                    'status' => GigResponse::STATUS_ACCEPTED,
                    'responded_at' => Carbon::now(),
                ]);
            }
            else {
                $this->gig->gigResponses()->firstOrCreate(['user_id' => $user_id] , ['user_id' => $user_id]);
            }
            
        }

        $this->closeSlideOver();

        return redirect()->route('gigs.show', ['gig' => $this->gig]);
    }

    public function render()
    {
        return view('livewire.gigs-edit');
    }
}
