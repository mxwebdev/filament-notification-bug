<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Gig;
use App\Models\GigResponse;
use App\Models\User;
use Livewire\Component;
use Carbon\CarbonPeriod;

class GigCalendar extends Component
{
    public $selectedDate;
    public $selectedDateRange;
    public $gigs;
    public Gig $editing;
    public $invitedUsers = [];

    public $showSlideOver = false;

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
        $this->selectedDate = Carbon::now();

        $this->editing = $this->makeBlankGig();
    }

    public function makeBlankGig()
    {
        return Gig::make([
            'status' => 0,
            'gig_start' => $this->selectedDate->format('Y-m-d'),
        ]);
    }
    
    public function setSelectedDate(String $date)
    {
        $this->selectedDate = Carbon::parse($date);
    }
    
    public function nextMonth()
    {
        $this->selectedDate->addMonthNoOverflow();
    }
    
    public function prevMonth()
    {
        $this->selectedDate->subMonthNoOverflow();
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
            $this->editing->gigResponses()->create(['user_id' => $user_id]);
        }

        $this->showSlideOver = false;
        $this->editing = $this->makeBlankGig();
    }
    
    public function render()
    {
        $rangeStart = Carbon::create($this->selectedDate)->startOfMonth();
        $rangeStart = $rangeStart->isMonday() ? $rangeStart : $rangeStart->subMonthNoOverflow()->lastOfMonth(1);
        
        $rangeEnd = Carbon::create($this->selectedDate)->endOfMonth();
        $rangeEnd = $rangeEnd->isSunday() ? $rangeEnd : $rangeEnd->addMonthNoOverflow()->firstOfMonth(0);
        
        $this->selectedDateRange = CarbonPeriod::create($rangeStart, $rangeEnd)->toArray();
        $this->gigs = auth()->user()->currentTeam->gigs()->whereDate('gig_start', '>=', $this->selectedDate)->orderBy('gig_start')->get();
        
        return view('livewire.gig-calendar');
    }
}
