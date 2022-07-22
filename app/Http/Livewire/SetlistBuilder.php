<?php

namespace App\Http\Livewire;

use App\Models\Gig;
use App\Models\Set;
use Livewire\Component;

class SetlistBuilder extends Component
{
    public Gig $gig;
    public $rep;
    public $searchTerm = '';

    public $collapseSets = false;

    protected $listeners = [
        'refresh' => '$refresh',
        'addSet' => 'addSet',
    ];
    
    public function addSet()
    {
        $set_number = $this->gig->sets()->count() + 1;

        $this->gig->sets()->create([
            'name' => 'Set '. $set_number,
            'position' => $set_number,
        ]);

        $this->emit('refresh');
    }

    public function updateSetOrder($sets)
    {
        foreach ($sets as $set) {
            if ($set['value'] != 0) {
                Set::find($set['value'])->update([
                    'position' => $set['order']
                ]);
            }
        }

        $this->gig->load('sets');
    }
    
    public function updateSongOrder($setsArray)
    {
        foreach ($setsArray as $set) {

            $song_ids = array_column($set['items'], 'value');
            $positions = array();

            for ($i=0; $i < count($song_ids); $i++) { 
                $positions[$i] = ['position' => $i+1];
            }

            $pivotData = array_combine($song_ids, $positions);

            if ($set['value'] != 0) {
                Set::find($set['value'])->songs()->sync($pivotData);
            }
        }

        $this->gig->load('songs', 'sets');
        //$this->rep = $this->gig->team->songs->diff($this->gig->songs);
    }

    public function render()
    {
        $this->rep = $this->gig->team->songs()->where('title', 'like', '%'.$this->searchTerm.'%')->get()->diff($this->gig->songs);

        return view('livewire.setlist-builder');
    }
}
