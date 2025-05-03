<div class="max-w-6xl mx-auto space-y-6">
    <!-- Header -->
    <div class="mb-4 flex flex-col gap-2 px-5 sm:flex-row sm:items-center sm:justify-between sm:px-6">
        <div>
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">Add New National Day</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Set a banner, music, and message that will notify all users on this date.
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
                <flux:input type="file" wire:model="banner" label="Banner Image" />
                @error('banner') <span class="text-sm text-red-600">{{ $message }}</span> @enderror

                @if ($banner)
                    <img src="{{ $banner->temporaryUrl() }}" class="mt-3 h-32 rounded shadow" alt="Banner Preview">
                @endif
            </div>

            <div>
                <flux:input type="file" wire:model="bg_music" label="Background Music (MP3/WAV)" accept=".mp3,.wav" />
                
                <!-- Upload Progress -->
                <div wire:loading wire:target="bg_music" class="mt-2">
                    <div class="h-2 bg-gray-200 rounded overflow-hidden">
                        <div class="h-full bg-blue-600 transition-all duration-300" style="width: {{ $uploadProgress }}%"></div>
                    </div>
                    <p class="text-xs mt-1 text-blue-700">
                        Uploading music... {{ (int)$uploadProgress }}%
                        @if($uploadProgress >= 100) Processing... @endif
                    </p>
                </div>

                @error('bg_music') <span class="text-sm text-red-600">{{ $message }}</span> @enderror

                @if ($bg_music && $musicUploaded)
                    <div class="mt-3">
                        <p class="text-sm text-green-600 mb-1">Music uploaded successfully!</p>
                        <audio controls class="w-full">
                            <source src="{{ $bg_music->temporaryUrl() }}" type="{{ $bg_music->getMimeType() }}">
                            Your browser does not support the audio element.
                        </audio>
                    </div>
                @endif
            </div>
        </div>

        <!-- Submit Button -->
        <div class="pt-4">
            <flux:button 
                type="submit" 
                class="w-full justify-center sm:w-auto"
                :disabled="!$musicUploaded"
            >
                Add National Day
            </flux:button>
            
            @if(!$musicUploaded && $bg_music)
                <p class="text-sm text-red-500 mt-2">Please wait for music upload to complete</p>
            @endif
        </div>
    </form>   
</div>