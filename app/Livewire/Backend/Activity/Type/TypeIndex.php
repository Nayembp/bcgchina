<?php

namespace App\Livewire\Backend\Activity\Type;

use App\Models\ActivityType;
use Livewire\Component;
use Livewire\WithPagination;

class TypeIndex extends Component
{
    use WithPagination;
    public $search = '';

    public function render()
    {
        $activities = ActivityType::query()
            ->when($this->search, function ($query) {
                $query->where('activity_type', 'like', '%' . $this->search . '%');
            })
            ->with('activities')->latest()
            ->paginate(10);
    
        return view('livewire.backend.activity.type.type-index', compact('activities'));
    }


    public function deleteActivity($id){
        $type = ActivityType::find($id);
        if($type){
            $type->delete();
            $this->dispatch('toast', message: 'Successfully deleted!', type: 'success');
        }else{
            $this->dispatch('toast', message: 'Unable to delete!', type: 'error');
        }
        
    }
}
