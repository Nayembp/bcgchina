<!-- resources/views/livewire/gallery-view.blade.php -->
<div>
  
    <div class="rounded-2xl border border-gray-200 bg-white pt-4 mt-2 dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="mb-4 flex flex-col gap-2 px-5 sm:flex-row sm:items-center sm:justify-between sm:px-6">
            <div>
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                    @if($selectedGallery)
                        {{ App\Models\Gallery::find($selectedGallery)->name }}
                    @else
                        Photo Gallery
                    @endif
                </h3>
            </div>
            <div class="flex gap-3">
                @if(!$selectedGallery)                
                    <flux:button wire:navigate href="{{ route('gallery.manage') }}" size="sm">Gallery Manage</flux:button>  
                @endif
                @if($selectedGallery)
                <flux:button wire:click="$set('addingPhoto', true)" size="sm"> Add Photo</flux:button> 
                
               
                    <a href="{{ route('gallery.view') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Galleries
                    </a>
                
                @endif
            </div>
        </div>

        <div class="px-5 sm:px-6 pb-5">
            @if(!$selectedGallery)
                <!-- Gallery Folders View -->                 
                  
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                    @foreach($galleries as $gallery)
                        <div wire:click="selectGallery({{ $gallery->id }})" 
                             class="group relative cursor-pointer rounded-lg border border-gray-200 overflow-hidden hover:shadow-md transition-shadow dark:border-gray-800">
                            <div class="aspect-square bg-gray-100 dark:bg-gray-800">
                                <img src="{{ asset('storage/' . $gallery->cover_image) }}" 
                                     class="w-full h-full object-cover"
                                     onerror="this.src='{{ asset('images/default-gallery.jpg') }}'">
                            </div>
                            <div class="p-3">
                                <h4 class="font-medium text-gray-800 dark:text-white/90 truncate">{{ $gallery->name }}</h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $gallery->photos_count }} photos</p>
                            </div>                           
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Photos in Selected Gallery -->
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">                   
                    @foreach($photos as $photo)
                        <div wire:click="showPhoto({{ $photo->id }})" 
                             class="group relative cursor-pointer rounded-lg border border-gray-200 overflow-hidden hover:shadow-md transition-shadow dark:border-gray-800">
                            <div class="aspect-square bg-gray-100 dark:bg-gray-800">
                                <img src="{{ asset('storage/' . $photo->image_path) }}" 
                                     class="w-full h-full object-cover">
                            </div>
                            <div class="p-2">
                                <p class="text-sm font-medium text-gray-800 dark:text-white/90 truncate">{{ $photo->title }}</p>
                            </div>
                            <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity flex gap-1">
                                <button wire:click.stop="deletePhoto({{ $photo->id }})" 
                                        class="p-1 bg-white/80 rounded-full hover:bg-white transition-colors">
                                    <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if($photos->isEmpty())
                    <div class="text-center py-12">
                        <div class="mx-auto w-24 h-24 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h4 class="mt-4 text-lg font-medium text-gray-900 dark:text-white">No photos in this gallery</h4>
                        <p class="mt-1 text-gray-500 dark:text-gray-400">Upload some photos to get started</p>
                        <button wire:click="$set('addingPhoto', true)"
                                class="mt-4 inline-flex items-center justify-center rounded-lg border border-transparent bg-brand-500 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-brand-600 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2">
                            Add Photo
                        </button>
                    </div>
                @endif
            @endif
        </div>
    </div>

    <!-- Add Photo Modal -->
    @if($addingPhoto)
        <div class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-md dark:bg-gray-800">
                <div class="p-5">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">Add New Photo</h3>
                        <button wire:click="$set('addingPhoto', false)" class="text-gray-400 hover:text-gray-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    
                    <form wire:submit.prevent="addPhoto">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Photo</label>
                                <input type="file" wire:model="newPhoto"
                                    class="w-full rounded-lg border border-gray-300 bg-transparent py-2 px-3 text-sm text-gray-800 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-brand-500/10 focus:border-brand-500 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                @error('newPhoto') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Title</label>
                                <input type="text" wire:model="title" required
                                    class="w-full rounded-lg border border-gray-300 bg-transparent py-2 px-3 text-sm text-gray-800 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-brand-500/10 focus:border-brand-500 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
                                <textarea wire:model="description"
                                    class="w-full rounded-lg border border-gray-300 bg-transparent py-2 px-3 text-sm text-gray-800 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-brand-500/10 focus:border-brand-500 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"></textarea>
                            </div>
                            
                            <div class="flex justify-end gap-3 pt-2">
                                <button type="button" wire:click="$set('addingPhoto', false)"
                                        class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2 dark:border-gray-700 dark:bg-gray-800 dark:text-white/90 dark:hover:bg-gray-700">
                                    Cancel
                                </button>
                                <button type="submit"
                                        class="inline-flex items-center justify-center rounded-lg border border-transparent bg-brand-500 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-brand-600 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2">
                                    Upload Photo
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <!-- Photo View Modal -->
    @if($showPhotoModal && $currentPhoto)
        <div class="fixed inset-0 bg-black/90 z-50 flex items-center justify-center p-4">
            <div class="relative w-full max-w-6xl">
                <button wire:click="$set('showPhotoModal', false)" 
                        class="absolute top-4 right-4 z-10 p-2 bg-black/50 rounded-full text-white hover:bg-black/70">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
                
                <div class="bg-white rounded-lg overflow-hidden dark:bg-gray-800">
                    <div class="flex flex-col md:flex-row">
                        <div class="md:w-2/3 bg-black flex items-center justify-center">
                            <img src="{{ asset('storage/' . $currentPhoto->image_path) }}" 
                                 class="max-h-[80vh] w-auto object-contain">
                        </div>
                        <div class="md:w-1/3 p-6">
                            <h3 class="text-xl font-semibold text-gray-800 dark:text-white/90">{{ $currentPhoto->title }}</h3>
                            @if($currentPhoto->description)
                                <p class="mt-2 text-gray-600 dark:text-gray-400">{{ $currentPhoto->description }}</p>
                            @endif
                            <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                                <button wire:click="deletePhoto({{ $currentPhoto->id }})" 
                                        class="inline-flex items-center text-red-500 hover:text-red-700">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Delete Photo
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>