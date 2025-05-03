<div>
    <div class="rounded-2xl border border-gray-200 bg-white pt-4 mt-2 dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="mb-4 flex flex-col gap-2 px-5 sm:flex-row sm:items-center sm:justify-between sm:px-6">
            <div>
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                    Manage Galleries
                </h3>
                <div class="mb-4">
                    <a href="{{ route('gallery.view') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Gallery View
                    </a>
                </div>
            </div>
        </div>

        <div class="px-5 sm:px-6 pb-5">
            <form wire:submit.prevent="save">
                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Gallery Name</label>
                        <input type="text" wire:model="name" required
                            class="w-full rounded-lg border border-gray-300 bg-transparent py-2 px-3 text-sm text-gray-800 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-brand-500/10 focus:border-brand-500 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                        @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
                        <input wire:model="description"
                            class="w-full rounded-lg border border-gray-300 bg-transparent py-2 px-3 text-sm text-gray-800 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-brand-500/10 focus:border-brand-500 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                    </div>
                    <div class="mt-6">
                        <flux:button type="submit" size="sm">
                            {{ $editMode ? 'Update Gallery' : 'Create New Gallery' }} 
                        </flux:button>                   
                    
                        @if($editMode)
                            <flux:button type="button" wire:click="resetForm" size="sm"> Cancel </flux:button>                 
                        @endif
                    </div>
                    
                </div>
            </form>
        
            

            <div class="mt-6">
                
                <h3 class="text-lg font-medium mb-4 text-gray-800 dark:text-white/90">Existing Galleries</h3>
                <flux:separator />
                <div class="space-y-4">
                    @foreach($galleries as $gallery)
                        <div class="flex justify-between items-center p-3 border rounded-lg dark:border-gray-800">
                            <div>
                                <h4 class="font-medium text-gray-800 dark:text-white/90">{{ $gallery->name }}</h4>
                                @if($gallery->description)
                                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ $gallery->description }}</p>
                                @endif
                            </div>
                            <div class="flex gap-2">
                                <button wire:click="edit({{ $gallery->id }})"
                                        class="text-blue-500 hover:text-blue-700 text-sm mr-3">
                                    Edit
                                </button>
                                <button wire:click="delete({{ $gallery->id }})" 
                                        class="text-red-500 hover:text-red-700 text-sm">
                                    Delete
                                </button>
                            </div>
                            
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>