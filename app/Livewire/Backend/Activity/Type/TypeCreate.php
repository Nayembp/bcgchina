<?php

namespace App\Livewire\Backend\Activity\Type;
use App\Models\ActivityType;
use Livewire\Component;

class TypeCreate extends Component
{

    public $activity_type;

    public function render()
    {
        return view('livewire.backend.activity.type.type-create');
    }

    public function typeStore()
    {
        // abort_unless(auth()->user()->can('settings.'), 403);
        // abort_unless(auth()->user()->hasRole('super-admin|admin'), 403);
        
        $validated = $this->validate([
            'activity_type' => 'required|string|min:3|unique:activity_types,activity_type',
        ]);

        ActivityType::create(['activity_type' => $validated['activity_type']]); 

        $this->dispatch('toast', message: 'New Type created!', type: 'success');
        $this->reset(['activity_type']);
        $this->resetErrorBag();

        return redirect()->route('activity.type.index');
       
    }
}
