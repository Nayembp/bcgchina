<?php

namespace App\Livewire\Backend\Gallery;

use App\Models\Gallery;
use App\Models\Photo;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;

class PhotoManager extends Component
{
    use WithFileUploads;
    
    public $galleries;
    public $selectedGallery;
    public $photos = [];
    public $titles = [];
    public $descriptions = [];
    public $uploadedPhotos = [];
    
    protected $rules = [
        'selectedGallery' => 'required|exists:galleries,id',
        'uploadedPhotos.*' => 'image|max:10240', // 10MB max
        'titles.*' => 'required|string|max:255',
        'descriptions.*' => 'nullable|string',
    ];
    
    public function mount()
    {
        $this->galleries = Gallery::all();
        $this->loadPhotos();
    }
    
    #[On('galleryUpdated')]
    public function loadPhotos()
    {
        if ($this->selectedGallery) {
            $this->photos = Photo::where('gallery_id', $this->selectedGallery)->get();
        } else {
            $this->photos = collect();
        }
    }
    
    public function updatedSelectedGallery()
    {
        $this->loadPhotos();
    }
    
    public function save()
    {
        $this->validate();
        
        foreach ($this->uploadedPhotos as $index => $photo) {
            $path = $photo->store("galleries/{$this->selectedGallery}", 'public');
            
            Photo::create([
                'gallery_id' => $this->selectedGallery,
                'title' => $this->titles[$index] ?? 'Untitled',
                'description' => $this->descriptions[$index] ?? null,
                'image_path' => $path,
            ]);
        }
        
        $this->reset(['uploadedPhotos', 'titles', 'descriptions']);
        $this->loadPhotos();
        
        session()->flash('message', 'Photos uploaded successfully.');
    }
    
    public function deletePhoto($id)
    {
        $photo = Photo::findOrFail($id);
        \Storage::disk('public')->delete($photo->image_path);
        $photo->delete();
        $this->loadPhotos();
        session()->flash('message', 'Photo deleted successfully.');
    }
    
    public function render()
    {
        return view('livewire.backend.gallery.photo-manager');
    }
}
