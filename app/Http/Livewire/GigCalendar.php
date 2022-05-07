<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use Carbon\CarbonPeriod;

class GigCalendar extends Component
{
    public $selectedDate;
    public $selectedDateRange;

    public function mount()
    {
        $this->selectedDate = Carbon::now();
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

    public function render()
    {
        $rangeStart = Carbon::create($this->selectedDate)->startOfMonth();
        $rangeStart = $rangeStart->isMonday() ? $rangeStart : $rangeStart->subMonthNoOverflow()->lastOfMonth(1);

        $rangeEnd = Carbon::create($this->selectedDate)->endOfMonth();
        $rangeEnd = $rangeEnd->isSunday() ? $rangeEnd : $rangeEnd->addMonthNoOverflow()->firstOfMonth(0);

        $this->selectedDateRange = CarbonPeriod::create($rangeStart, $rangeEnd)->toArray();

        return view('livewire.gig-calendar');
    }
}
