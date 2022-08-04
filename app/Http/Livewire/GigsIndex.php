<?php

namespace App\Http\Livewire;

use App\Models\Gig;
use Livewire\Component;
use App\Models\GigResponse;
use Carbon\Carbon;
use Livewire\WithPagination;

class GigsIndex extends Component
{
    use WithPagination;

    public Gig $editing;
    public $invitedUsers = [];
    public $upcomingGigsCount;

    public $showSlideOver = false;

    public $filters = [
        'search' => '',
        'date_min' => null,
        'date_max' => null,
    ];

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

        $this->filters['date_min'] = Carbon::now()->format('Y-m-d');

        $lastGig = Gig::orderBy('gig_start', 'desc')->first();
        $this->filters['date_max'] = $lastGig->gig_start->format('Y-m-d');
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

        $this->dispatchBrowserEvent('banner-message', [
            'style' => 'success',
            'message' => __('Gig saved!')
        ]);
    }

    public function getRowsQueryProperty()
    {
        $query = Gig::query()
            ->where('team_id', auth()->user()->currentTeam->id)
            ->when($this->filters['search'], fn($query, $search) => $query->where('name', 'like', '%'.$search.'%')
                                                                        ->orWhere('location', 'like', '%'.$search.'%'))
            ->when($this->filters['date_min'], fn($query, $date) => $query->where('gig_start', '>=', Carbon::parse($date)))
            ->when($this->filters['date_max'], fn($query, $date) => $query->where('gig_start', '<=', Carbon::parse($date)))
            ->orderBy('gig_start')
            ->with('creator', 'gigResponses');

        return $query;
    }

    public function getRowsProperty()
    {
        return $this->rowsQuery->paginate(10);
    }
    
    public function render()
    {   
        return view('livewire.gigs-index', [
            'gigs' => $this->rows,
        ]);
    }
}
