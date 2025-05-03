<div>    
    <div class="mb-4 flex flex-col gap-2 px-5 sm:flex-row sm:items-center sm:justify-between sm:px-6">
        <div>
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
            Type
            </h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Create a new activity
            </p>
        </div>

        <!-- Back Button -->
        <div class="flex items-center gap-2 mt-3 sm:mt-0">
            <a wire:navigate href="{{ route('activity.type.index') }}" class="flex items-center text-sm text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                <span>Back</span>
            </a>
        </div>
    </div> 
    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow mb-2 mt-2">
        

        <form wire:submit.prevent="typeStore" class="flex flex-col md:flex-row md:items-center md:space-x-4 space-y-3 md:space-y-0">
        
            <div class="flex flex-col">
                <flux:input.group>
                    <flux:input wire:model="activity_type" placeholder="Activity Type" />
                    <flux:button  type="submit" icon="plus">Save</flux:button>
                </flux:input.group>
                
                @error('activity_type')
                    <span class="text-red-600 text-sm mt-3">{{ $message }}</span>
                @enderror
            </div>                                        
        </form>
    </div>
</div>
