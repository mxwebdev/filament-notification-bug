<?php

namespace App\Http\Livewire;

use App\Models\Set;
use Livewire\Component;

class SetsEdit extends Component
{
    public Set $editing;

    public $showSlideOver = false;

    protected $listeners = ['openEditSetSlideOver' => 'openSlideOver'];

    public function mount()
    {
        $this->editing = Set::make();
    }

    public function rules() {
        return [
            'editing.name' => 'required|string',
        ];
    }

    public function openSlideOver($set_id)
    {
        $this->editing = Set::findOrFail($set_id);
        $this->showSlideOver = true;
    }

    public function closeSlideOver()
    {
        $this->showSlideOver = false;
    }

    public function save()
    {   
        $this->validate();
        $this->editing->save();

        $this->closeSlideOver();

        $this->emitTo('setlist-builder', 'refresh');
    }

    public function deleteSet()
    {
        $this->editing->songs()->detach();
        $this->editing->delete();

        $this->closeSlideOver();

        $this->emitTo('setlist-builder', 'refresh');
    }

    public function render()
    {
        return view('livewire.sets-edit');
    }
}
