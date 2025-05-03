<?php

namespace App\Livewire\Backend\Gallery;

use App\Models\Gallery;
use App\Models\Photo;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;

class GalleryView extends Component
{
    use WithFileUploads;
    
    public $galleries;
    public $selectedGallery = null;
    public $photos = [];
    public $showPhotoModal = false;
    public $currentPhoto = null;
    public $newPhoto;
    public $title = '';
    public $description = '';
    public $addingPhoto = false;
    
    public function mount()
    {
        $this->galleries = Gallery::withCount('photos')->get();
    }
    
    public function selectGallery($galleryId)
    {
        $this->selectedGallery = $galleryId;
        $this->photos = Photo::where('gallery_id', $galleryId)->get();
    }
    
    public function showPhoto($photoId)
    {
        $this->currentPhoto = Photo::find($photoId);
        $this->showPhotoModal = true;
    }
    
    public function addPhoto()
    {
        $this->validate([
            'newPhoto' => 'required|image|max:10240',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        
        $path = $this->newPhoto->store("galleries/{$this->selectedGallery}", 'public');
        
        Photo::create([
            'gallery_id' => $this->selectedGallery,
            'title' => $this->title,
            'description' => $this->description,
            'image_path' => $path,
        ]);
        
        $this->reset(['newPhoto', 'title', 'description']);
        $this->photos = Photo::where('gallery_id', $this->selectedGallery)->get();
        
        $this->dispatch('toast', 
            message: 'Photo added successfully!', 
            type: 'success'
        );
    }
    
    public function deletePhoto($photoId)
    {
        $photo = Photo::findOrFail($photoId);
        \Storage::disk('public')->delete($photo->image_path);
        $photo->delete();
        
        $this->photos = Photo::where('gallery_id', $this->selectedGallery)->get();
        
        $this->dispatch('toast', 
            message: 'Photo deleted successfully!', 
            type: 'success'
        );
    }

}
