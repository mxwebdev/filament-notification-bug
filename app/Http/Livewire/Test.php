<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Filament\Notifications\Notification;

class Test extends Component
{
    public function render()
    {
        Notification::make() 
            ->title('Saved successfully')
            ->success()
            ->send(); 
            
        return view('livewire.test');
    }
}
