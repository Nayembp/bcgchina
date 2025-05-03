<?php

namespace App\Livewire\Backend\Activity\Type;

use Livewire\Component;
use App\Models\ActivityType;

class TypeEdit extends Component
{
    public $activity_type;
    public $typeId;

    public function mount($id)
    {
       
        $type = ActivityType::findOrFail($id);
        $this->activity_type = $type->activity_type;
        $this->typeId = $id; 
    }

    public function rules()
    {
        return [
            'activity_type' => ['required', 'string', 'max:255', 'unique:activity_types,activity_type,' . $this->typeId],
        ];
    }

    public function update()
    {
        $this->validate();
        $activityType = ActivityType::findOrFail($this->typeId);
        $activityType->update([
            'activity_type' => $this->activity_type,            
        ]);

    
        $this->dispatch('toast', message: 'Type Update', type: 'success');

        return redirect()->route('activity.type.index');
    }

    public function render()
    {
        return view('livewire.backend.activity.type.type-edit');
    }
}
