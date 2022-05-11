<?php

namespace App\Http\Livewire\Teams;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class UpdateTeamPhotoForm extends Component
{
    use WithFileUploads;
    
    /**
     * The team instance.
     *
     * @var mixed
     */
    public $team;

    /**
     * The component's state.
     *
     * @var array
     */
    public $state = [];

    /**
     * The new avatar for the team.
     *
     * @var mixed
     */
    public $photo;

    /**
     * Mount the component.
     *
     * @param  mixed  $team
     * @return void
     */
    public function mount($team)
    {
        $this->team = $team;

        $this->state = $team->withoutRelations()->toArray();
    }

    /**
     * Update team photo.
     *
     * @return void
     */
    public function updateTeamPhoto()
    {
        $this->resetErrorBag();

        if (isset($this->photo)) {
             $this->team->updateTeamPhoto($this->photo);
        }
       
        return redirect()->route('teams.show', $this->team->id);

        $this->emit('saved');

        $this->emit('refresh-navigation-menu');
    }

    /**
     * Delete team photo.
     *
     * @return void
     */
    public function deleteTeamPhoto()
    {
        $this->team->deleteTeamPhoto();

        $this->emit('refresh-navigation-menu');
    }

    /**
     * Get the current user of the application.
     *
     * @return mixed
     */
    public function getUserProperty()
    {
        return Auth::user();
    }

    public function render()
    {
        return view('teams.update-team-photo-form');
    }
}
