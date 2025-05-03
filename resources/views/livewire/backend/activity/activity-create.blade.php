<div>
    <div>    
        <div class="mb-4 flex flex-col gap-2 px-5 sm:flex-row sm:items-center sm:justify-between sm:px-6">
            <div>
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                Activity
                </h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Create a new activity
                </p>
            </div>
    
            <!-- Back Button -->
            <div class="flex items-center gap-2 mt-3 sm:mt-0">
                <a wire:navigate href="{{ route('activity.index') }}" class="flex items-center text-sm text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    <span>Back</span>
                </a>
            </div>
        </div> 
        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow mb-2 mt-2">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Activity Form</h2>
        
            <form wire:submit.prevent="activityStore" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label for="activityType" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Activity Type</label>
                    <select wire:model="activityType" id="activityType" class="mt-2 block w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Select Activity Type</option>
                        @foreach($allActivity as $id => $activity)
                            <option value="{{ $id }}">{{ $activity }}</option>
                        @endforeach
                    </select>
                    @error('activityType') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                
                <div>
                    <flux:input wire:model="name" label="Activity Name" placeholder="Enter name here"  />
                </div>
        
                <div>
                    <flux:input wire:model="title" label="Activity Title" placeholder="Enter title here" />
                </div>
        
                <div>
                    <flux:input type="number" wire:model="expanse" placeholder="Amount here" label="Activity Expanse Amount" />
                </div>
        
                <div class="md:col-span-3">
                    <flux:textarea wire:model="description" label="Description" placeholder="Enter description here"  />
                </div>
        
                <div>
                    <flux:input type="file" wire:model="banner" label="Attachments" />
                </div>
        
                <div class="md:col-span-3">
                    <flux:button type="submit">
                        Save
                    </flux:button>
                </div>
            </form>
        </div>
        
    </div>
    
</div>
