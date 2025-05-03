<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\User;
use App\Models\Activity;
class Welcome extends Component
{
    public function render()
    {
        $members = User::get();
        $activities = Activity::get();
        return view('livewire.frontend.welcome',
             compact(
                'members',
                'activities',
            ))->layout('livewire.frontend.layouts.app');
    }
}
