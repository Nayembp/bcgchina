<?php

namespace App\Livewire\Backend\Activity;
use Livewire\WithFileUploads;
use Livewire\Component;
use App\Models\Activity;
use App\Models\ActivityType;
use Illuminate\Support\Facades\Storage;
class ActivityCreate extends Component
{
    use WithFileUploads;

    public $name, $title, $description, $banner, $expanse, $activityType;
    public $allActivity;

   
    public function mount()
    {
        $this->allActivity = ActivityType::pluck('activity_type', 'id')->toArray(); 
    }

    public function render()
    {
        return view('livewire.backend.activity.activity-create');
    }

    public function activityStore()
    {
        
        $validated = $this->validate([
            'activityType' => 'required|exists:activity_types,id',
            'name' => 'required|string|min:3',
            'title' => 'required|string',
            'description' => 'required|string',
            'expanse' => 'required|numeric',
            'banner' => 'nullable|file|mimetypes:image/jpeg,image/png|max:1024',
        ]);

        if ($this->banner) {
            $validated['banner'] = $this->banner->store('banners', 'public');
        }

        
        Activity::create([
            'type_id' => $validated['activityType'],
            'name' => $validated['name'],
            'title' => $validated['title'],
            'description' => $validated['description'],
            'expanse' => $validated['expanse'],
            'banner' => $validated['banner'] ?? null,
        ]);


        $this->dispatch('toast', message: 'New Activity created!', type: 'success');
        
    
        $this->reset(['name', 'title', 'description', 'expanse', 'banner', 'activityType']);
        $this->resetErrorBag();


        return redirect()->route('activity.index');
    }
}

