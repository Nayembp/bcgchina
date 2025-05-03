<?php

namespace App\Livewire\Backend;

use Livewire\Component;
use App\Models\User;
use App\Models\ActivityType;
use App\Models\Activity;
use App\Models\Company;
class Dashboard extends Component
{
    public $company = '';
    public $users = '';
    public $activityType = '';
    public $activities = '';
    public function mount(){

        $this->users = User::count();
        $this->activityType = ActivityType::count();
        $this->activities = Activity::count();
        $this->company = Company::first();
       
    }
    public function render()
    {
        return view('livewire.backend.dashboard');
    }
}
