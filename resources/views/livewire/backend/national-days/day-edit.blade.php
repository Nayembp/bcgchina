<div class="max-w-6xl mx-auto space-y-6">
    <!-- Header -->
    <div class="mb-4 flex flex-col gap-2 px-5 sm:flex-row sm:items-center sm:justify-between sm:px-6">
        <div>
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">Edit National Day</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Update the event details, banner, and background music.
            </p>
        </div>
        <div class="flex items-center gap-2 mt-3 sm:mt-0">
            <a href="{{ route('national.day.index') }}" class="text-sm text-gray-700 hover:underline dark:text-gray-300">← Back</a>
        </div>
    </div>

    <!-- Form -->
    <form wire:submit.prevent="save" class="space-y-6 px-5 sm:px-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <flux:input wire:model="name" label="Event Name" placeholder="e.g. Independence Day" />
                @error('name') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>

            <div>
                <flux:input type="date" wire:model="date" label="Event Date" />
                @error('date') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>

            <div class="sm:col-span-2">
                <flux:textarea wire:model="note" label="Note" placeholder="Type the event note" />
                @error('note') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>

            <div class="flex items-center mt-4 sm:col-span-2">
                <input wire:model="is_active" type="checkbox" id="is_active" class="mr-2 rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                <label for="is_active" class="text-sm text-gray-700 dark:text-gray-300">Mark as Active</label>
            </div>

            <div>
                @if ($banner)
                    <img src="{{ $banner->temporaryUrl() }}" class="h-32 rounded shadow mb-2" alt="New Banner Preview">
                @elseif ($event->banner)
                    <img src="{{ asset('storage/' . $event->banner) }}" class="h-32 rounded shadow mb-2" alt="Current Banner">
                @endif
            
                <flux:input type="file" wire:model="banner" label="Upload New Banner" accept="image/*" />
                @error('banner') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>

            <div>
                {{-- New music selected (upload in progress or done) --}}
                @if ($bg_music)
                    @if ($musicUploaded)
                        <p class="text-sm text-green-600 dark:text-green-400 mb-2">
                            New Music Selected: {{ $bg_music->getClientOriginalName() }}
                        </p>
                        <audio controls class="w-full">
                            <source src="{{ $bg_music->temporaryUrl() }}" type="{{ $bg_music->getMimeType() }}">
                            Your browser does not support the audio element.
                        </audio>
                    @endif

                @endif
            
                <flux:input type="file" wire:model="bg_music" label="Upload Background Music" accept=".mp3,.wav" />
                @error('bg_music') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            
                
                @if ($musicUploaded)
                    <div class="w-full bg-gray-200 rounded h-2.5 dark:bg-gray-700 mt-2 relative">
                        <div class="bg-blue-600 h-2.5 rounded" style="width: {{ $uploadProgress }}%"></div>
                        <span class="absolute right-2 top-0 text-xs text-gray-600 dark:text-gray-300">{{ intval($uploadProgress) }}%</span>
                    </div>
                @endif
            </div>
            

        <!-- Submit Button -->
        <div class="pt-4">
            <flux:button type="submit" class="w-full justify-center sm:w-auto" :disabled="!$musicUploaded">
                Update National Day
            </flux:button>
        </div>
    </form>
</div>
