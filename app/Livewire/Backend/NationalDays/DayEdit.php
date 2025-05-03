<?php

namespace App\Livewire\Backend\NationalDays;

use Livewire\WithFileUploads;
use Livewire\Component;
use App\Models\NationalDay;
use Illuminate\Support\Facades\Storage;

class DayEdit extends Component
{
    use WithFileUploads;
    
    public $event;
    public $name, $note, $date, $is_active = false;
    public $banner, $bg_music;
    public $uploadProgress = 0;
    public $musicUploaded = true;

    public function mount($id)
    {
        $this->event = NationalDay::findOrFail($id);
        $this->fill($this->event->only(['name', 'note', 'date', 'is_active']));
    }

    protected $rules = [
        'name' => 'required|string|max:255',
        'note' => 'required|string|max:255',
        'date' => 'required|date',
        'banner' => 'nullable|image|max:2048',
        'bg_music' => 'nullable|mimes:mp3,wav|max:10240',
    ];

    public function updatedBgMusic()
    {
        $this->validateOnly('bg_music');
        $this->musicUploaded = false;
        $this->uploadProgress = 0;
        $this->progressSimulator();
    }

    protected function progressSimulator()
    {
        $steps = 20;
        $interval = 50; // milliseconds

        for ($i = 1; $i <= $steps; $i++) {
            usleep($interval * 1000);
            $this->uploadProgress = ($i / $steps) * 100;
            $this->dispatch('$refresh'); // update progress bar in frontend
        }

        $this->musicUploaded = true;
    }

    public function save()
    {
        $validated = $this->validate();

        // Handle new banner upload
        if ($this->banner) {
            if ($this->event->banner && Storage::disk('public')->exists($this->event->banner)) {
                Storage::disk('public')->delete($this->event->banner);
            }
            $validated['banner'] = $this->banner->store('banners', 'public');
        } else {
            unset($validated['banner']); // prevent null overwrite
        }

        // Handle new bg_music upload
        if ($this->bg_music) {
            if ($this->event->bg_music && Storage::disk('public')->exists($this->event->bg_music)) {
                Storage::disk('public')->delete($this->event->bg_music);
            }
            $validated['bg_music'] = $this->bg_music->store('music', 'public');
        } else {
            unset($validated['bg_music']); // prevent null overwrite
        }

        $this->event->update(array_merge($validated, [
            'is_active' => $this->is_active,
        ]));

        $this->dispatch('toast', message: 'National Day updated!', type: 'success');
        return redirect()->route('national.day.index');
    }

    public function render()
    {
        return view('livewire.backend.national-days.day-edit');
    }
}
