<?php

namespace App\Livewire\Backend\Gallery;
use App\Models\Gallery;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class GalleryManager extends Component
{
    use WithFileUploads;
    
    public $name;
    public $description;
    public $galleries;
    
    public $editMode = false;
    public $editingId = null;

    protected $rules = [
        'name' => 'required|min:3',
        'description' => 'nullable|string',
    ];
    
    public function mount()
    {
        $this->galleries = Gallery::all();
    }
    
    public function save()
    {
        $this->validate();

        if ($this->editMode && $this->editingId) {
            $gallery = Gallery::findOrFail($this->editingId);
            $gallery->update([
                'name' => $this->name,
                'slug' => Str::slug($this->name),
                'description' => $this->description,
            ]);

            session()->flash('message', 'Gallery updated successfully.');
        } else {
            Gallery::create([
                'name' => $this->name,
                'slug' => Str::slug($this->name),
                'description' => $this->description,
            ]);

            session()->flash('message', 'Gallery created successfully.');
        }

        $this->resetForm();
        $this->galleries = Gallery::all();
    }

    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);
        $this->editingId = $id;
        $this->name = $gallery->name;
        $this->description = $gallery->description;
        $this->editMode = true;
    }

    public function resetForm()
    {
        $this->reset(['name', 'description', 'editMode', 'editingId']);
    }


    
    public function delete($id)
    {
        Gallery::findOrFail($id)->delete();
        $this->galleries = Gallery::all();
        session()->flash('message', 'Gallery deleted successfully.');
    }

    public function render()
    {
        return view('livewire.backend.gallery.gallery-manager');
    }
}
