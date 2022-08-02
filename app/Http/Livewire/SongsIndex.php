<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\WithSorting;
use App\Models\Song;
use Livewire\Component;
use Livewire\WithPagination;

class SongsIndex extends Component
{
    use WithPagination, WithSorting;

    public Song $editing;
    
    public $showSlideOver = false;

    public $filters = [
        'search' => '',
    ];

    protected $queryString = ['sorts'];

    protected $listeners = ['openCreateSongSlideOver' => 'createSong'];

    public function rules() {
        return [
            'editing.title' => 'required|string',
            'editing.artist' => 'required|string',
            'editing.song_key' => 'nullable|string',
            'editing.bpm' => 'nullable|numeric|integer|min:0',
        ];
    }

    public function mount()
    {
        $this->editing = $this->makeBlankSong();
    }

    public function openSlideOver()
    {   
        $this->showSlideOver = true;
    }

    public function closeSlideOver()
    {
        $this->showSlideOver = false;
    }

    public function makeBlankSong()
    {
        return Song::make();
    }

    public function createSong()
    {
        $this->editing = $this->makeBlankSong();
        $this->openSlideOver();
    }

    public function editSong(Song $song)
    {
        $this->editing = $song;
        $this->openSlideOver();
    }

    public function save()
    {   
        $this->validate();

        $this->editing->team_id = auth()->user()->currentTeam->id;
        $this->editing->save();

        $this->closeSlideOver();
    }

    public function getRowsQueryProperty()
    {
        $query = Song::query()
            ->where('team_id', auth()->user()->currentTeam->id)
            ->when($this->filters['search'], fn($query, $search) => $query->where('title', 'like', '%'.$search.'%'))
            ->with('files');

        return $this->applySorting($query);
    }

    public function getRowsProperty()
    {
        return $this->rowsQuery->paginate(25);
    }

    public function render()
    {
        return view('livewire.songs-index', [
            'songs' => $this->rows,
        ]);
    }
}
