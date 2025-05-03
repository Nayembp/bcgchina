<?php

namespace App\Livewire\Backend\Activity;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use App\Models\Activity;
use App\Models\ActivityType;
class ActivityIndex extends Component
{
    public $search;

    public function render()
    {         
         $activities = Activity::query()
         ->where('name', 'like', '%' . $this->search . '%')
         ->orWhere('title', 'like', '%' . $this->search . '%')
         ->with('type')  
         ->paginate(10);
        return view('livewire.backend.activity.activity-index', compact('activities'));
    }


    public function deleteActivity($id)
    {
        $activity = Activity::find($id);

        if ($activity) {
            if ($activity->banner && Storage::disk('public')->exists($activity->banner)) {
                Storage::disk('public')->delete($activity->banner);
            }

            $activity->delete();

            $this->dispatch('toast', message: 'Successfully deleted!', type: 'success');
        } else {
            $this->dispatch('toast', message: 'Unable to delete!', type: 'error');
        }
    }
}
