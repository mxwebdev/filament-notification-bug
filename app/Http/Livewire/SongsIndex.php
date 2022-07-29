<?php

namespace App\Http\Livewire;

use App\Models\Song;
use Livewire\Component;
use Livewire\WithPagination;

class SongsIndex extends Component
{
    use WithPagination;

    public Song $editing;
    
    public $showSlideOver = false;

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

    public function render()
    {
        $songs = auth()->user()->currentTeam->songs()
            ->with('files')
            ->orderBy('title')
            ->paginate(25);

        return view('livewire.songs-index', [
            'songs' => $songs,
        ]);
    }
}
