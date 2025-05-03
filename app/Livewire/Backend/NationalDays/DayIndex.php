<?php

namespace App\Livewire\Backend\NationalDays;

use Livewire\Component;
use App\Models\NationalDay;
class DayIndex extends Component
{
    public function render()
    {
        $events =NationalDay::latest()->paginate(10);
        return view('livewire.backend.national-days.day-index', compact('events'));
    }
}
