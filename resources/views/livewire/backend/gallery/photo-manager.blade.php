<div>
    <div class="rounded-2xl border border-gray-200 bg-white pt-4 mt-2 dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="mb-4 flex flex-col gap-2 px-5 sm:flex-row sm:items-center sm:justify-between sm:px-6">
            <div>
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                    Manage Photos
                </h3>
            </div>
        </div>

        <div class="px-5 sm:px-6 pb-5">
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Select Gallery</label>
                <select wire:model.live="selectedGallery"
                    class="w-full rounded-lg border border-gray-300 bg-transparent py-2 px-3 text-sm text-gray-800 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-brand-500/10 focus:border-brand-500 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                    <option value="">Select a gallery</option>
                    @foreach($galleries as $gallery)
                        <option value="{{ $gallery->id }}">{{ $gallery->name }}</option>
                    @endforeach
                </select>
            </div>

            @if($selectedGallery)
                <form wire:submit.prevent="save">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Upload Photos</label>
                            <input type="file" wire:model="uploadedPhotos" multiple
                                class="w-full rounded-lg border border-gray-300 bg-transparent py-2 px-3 text-sm text-gray-800 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-brand-500/10 focus:border-brand-500 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                            @error('uploadedPhotos.*') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        @if($uploadedPhotos)
                            <div class="space-y-4">
                                @foreach($uploadedPhotos as $index => $photo)
                                    <div class="border p-4 rounded-lg dark:border-gray-800">
                                        <div class="flex space-x-4">
                                            <div class="w-24">
                                                <img src="{{ $photo->temporaryUrl() }}" class="h-20 w-20 object-cover rounded">
                                            </div>
                                            <div class="flex-1 space-y-2">
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Title</label>
                                                    <input type="text" wire:model="titles.{{ $index }}" required
                                                        class="w-full rounded-lg border border-gray-300 bg-transparent py-2 px-3 text-sm text-gray-800 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-brand-500/10 focus:border-brand-500 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
                                                    <textarea wire:model="descriptions.{{ $index }}"
                                                        class="w-full rounded-lg border border-gray-300 bg-transparent py-2 px-3 text-sm text-gray-800 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-brand-500/10 focus:border-brand-500 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <button type="submit" 
                                    class="mt-4 inline-flex items-center justify-center rounded-lg border border-transparent bg-brand-500 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-brand-600 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2">
                                Upload Photos
                            </button>
                        @endif
                    </div>
                </form>

                @if (session()->has('message'))
                    <div class="mt-4 p-3 bg-green-100 text-green-700 rounded-lg text-sm">
                        {{ session('message') }}
                    </div>
                @endif

                <div class="mt-8">
                    <h3 class="text-lg font-medium mb-4 text-gray-800 dark:text-white/90">Photos in this Gallery</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach($photos as $photo)
                            <div class="border rounded-lg overflow-hidden dark:border-gray-800">
                                <img src="{{ asset('storage/' . $photo->image_path) }}" 
                                     class="w-full h-48 object-cover">
                                <div class="p-3">
                                    <h4 class="font-medium text-gray-800 dark:text-white/90">{{ $photo->title }}</h4>
                                    @if($photo->description)
                                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ $photo->description }}</p>
                                    @endif
                                    <button wire:click="deletePhoto({{ $photo->id }})" 
                                            class="text-red-500 text-sm mt-2 hover:text-red-700">
                                        Delete
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>