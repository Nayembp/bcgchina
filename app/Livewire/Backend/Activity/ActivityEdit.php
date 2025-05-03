<?php

namespace App\Livewire\Backend\Activity;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Activity;
use App\Models\ActivityType;

class ActivityEdit extends Component
{
    use WithFileUploads;

    public $activityId;
    public $name, $title, $description, $banner, $expanse, $activityType;
    public $allActivity, $existingBanner,$oldBanner;

    public function mount($id)
    {
        $activity = Activity::findOrFail($id);
        $this->activityId = $id;

        $this->name = $activity->name;
        $this->title = $activity->title;
        $this->description = $activity->description;
        $this->expanse = $activity->expanse;
        $this->activityType = $activity->type_id;
        $this->existingBanner = $activity->banner;
        $this->oldBanner = $activity->banner;

        $this->allActivity = ActivityType::pluck('activity_type', 'id')->toArray(); 
    }

    public function updateActivity()
    {
        $validated = $this->validate([
            'activityType' => 'required|exists:activity_types,id',
            'name' => 'required|string|min:3',
            'title' => 'required|string',
            'description' => 'required|string',
            'expanse' => 'required|numeric',
            'banner' => 'nullable|file|mimes:jpeg,png,jpg|max:1024',
        ]);

        if ($this->banner) {
            if (!empty($this->oldBanner) && Storage::disk('public')->exists($this->oldBanner)) {
                Storage::disk('public')->delete($this->oldBanner);
            }
            $validated['banner'] = $this->banner->store('banners', 'public');
        }

        $activity = Activity::findOrFail($this->activityId);
        $activity->update([
            'activity_type_id' => $this->activityType,
            'name' => $this->name,
            'title' => $this->title,
            'description' => $this->description,
            'expanse' => $this->expanse,
            'banner' => $validated['banner'] ?? $this->existingBanner,
        ]);

        $this->dispatch('toast', message: 'Activity updated!', type: 'success');

        return redirect()->route('activity.index');
    }

    public function render()
    {
        return view('livewire.backend.activity.activity-edit');
    }
}

