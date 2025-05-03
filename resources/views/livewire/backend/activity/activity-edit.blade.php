<div>
    <div class="mb-4 flex flex-col gap-2 px-5 sm:flex-row sm:items-center sm:justify-between sm:px-6">
        <div>
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">Edit Activity</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">Update the existing activity</p>
        </div>
        <div>
            <a wire:navigate href="{{ route('activity.index') }}" class="text-sm text-blue-600 hover:underline">Back</a>
        </div>
    </div>
    
    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow mb-2 mt-2">
        <form wire:submit.prevent="updateActivity" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label for="activityType" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Activity Type</label>
                <select wire:model="activityType" id="activityType" class="mt-2 block w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="">Select Activity Type</option>
                    @foreach($allActivity as $id => $type)
                        <option value="{{ $id }}">{{ $type }}</option>
                    @endforeach
                </select>
                @error('activityType') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
    
            <div><flux:input wire:model="name" label="Activity Name" placeholder="Enter name" /></div>
            <div><flux:input wire:model="title" label="Activity Title" placeholder="Enter title" /></div>
            <div><flux:input type="number" wire:model="expanse" label="Activity Expanse Amount" /></div>
    
            <div class="md:col-span-3">
                <flux:textarea wire:model="description" label="Description" />
            </div>
    
            <div>
                @if($existingBanner)
                    <p class="text-sm text-gray-600 dark:text-gray-300 mb-2">Current Banner:</p>
                    <img src="{{ asset('storage/' . $existingBanner) }}" class="w-24 rounded" alt="Banner" />
                @endif
                <flux:input type="file" wire:model="banner" label="Update Banner" />
            </div>
    
            <div class="md:col-span-3">
                <flux:button type="submit">Update</flux:button>
            </div>
        </form>
    </div>
    
    
</div>
