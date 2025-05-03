<?php

namespace App\Livewire\Backend\NationalDays;

use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Livewire\Component;
use App\Models\NationalDay;

class DayCreate extends Component
{
    use WithFileUploads;

    public $name, $note, $date, $is_active = false;
    public $banner, $bg_music;
    public $uploadProgress = 0;
    public $musicUploaded = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'note' => 'required|string|max:255',
        'date' => 'required|date',
        'banner' => 'required|image|max:2048',
        'bg_music' => 'required|mimes:mp3,wav|max:10240',
    ];

    public function updatedBgMusic()
    {
        $this->validateOnly('bg_music');
        $this->musicUploaded = false;
        
        // Simulate upload progress (in real app, this would come from JavaScript)
        $this->uploadProgress = 0;
        
        // Fake progress for demo - in real app use Livewire's upload events
        $this->progressSimulator();
    }

    protected function progressSimulator()
    {
        // This is just for demo - in production, Livewire handles this automatically
        $steps = 10;
        $interval = 100; // milliseconds
        
        for ($i = 1; $i <= $steps; $i++) {
            usleep($interval * 1000);
            $this->uploadProgress = ($i / $steps) * 100;
            $this->dispatch('progress-updated', progress: $this->uploadProgress);
        }
        
        $this->musicUploaded = true;
    }

    public function save()
    {
        $validated = $this->validate();

        // Only proceed if music is uploaded
        if (!$this->musicUploaded) {
            $this->dispatch('toast', message: 'Please complete music upload first!', type: 'error');
            return;
        }

        $validated['banner'] = $this->banner->store('banners', 'public');
        $validated['bg_music'] = $this->bg_music->store('music', 'public');
        $validated['is_active'] = $this->is_active;

        NationalDay::create($validated);

        $this->dispatch('toast', message: 'National Day Created!', type: 'success');
        $this->reset();
        return redirect()->route('activity.index');
    }

    public function render()
    {
        return view('livewire.backend.national-days.day-create');
    }
}