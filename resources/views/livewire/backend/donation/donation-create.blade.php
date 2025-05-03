<div class="max-w-6xl mx-auto space-y-6">
    <!-- Header Section -->
    <div class="mb-4 flex flex-col gap-2 px-5 sm:flex-row sm:items-center sm:justify-between sm:px-6">
        <div>
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                Add New Donation
            </h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Create a new user donation
            </p>
        </div>

        <!-- Back Button -->
        <div class="flex items-center gap-2 mt-3 sm:mt-0">
            <a wire:navigate href="{{ route('donation.index') }}" class="flex items-center text-sm text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                <span>Back</span>
            </a>
        </div>
    </div>

    <!-- Form Section -->
    <div class="space-y-4 px-5 sm:px-6">
        
        <div class="relative">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Select a user</label>
            <input 
                type="text" 
                class="w-full px-3 py-2 border rounded-md shadow-sm dark:bg-gray-700 dark:text-white dark:border-gray-600"
                placeholder="Type user name to search"
                wire:model.live="search"
                value="{{ $selectedUserName }}"
                autocomplete="off"
                required
            />
        
            @if(strlen($search) > 0 && count($users) > 0)
                <ul class="absolute z-10 w-full bg-white border border-gray-300 rounded-md shadow mt-1 max-h-60 overflow-auto dark:bg-gray-800 dark:border-gray-600">
                    @foreach($users as $u)
                        <li 
                            wire:click="selectUser({{ $u->id }})" 
                            class="px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer"
                        >
                            {{ $u->name }} | {{ $u->permanent_adress }}
                        </li>
                    @endforeach
                </ul>          
            @endif
        
            <!-- Display error message only if 'user' field has validation errors -->
            @error('user')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>
        

        
        <flux:input 
            type="number" 
            wire:model="amount" 
            label="Payment Amount" 
            placeholder="Enter amount"
            required
        />
        @error('amount')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror

        <!-- Note -->
        <flux:input 
            type="textarea" 
            wire:model="note" 
            label="Note" 
            placeholder="Optional note"
            required
        />
        @error('note')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror

        <!-- Submit Button -->
        <div class="pt-4">
            <flux:button 
                wire:click="save" 
                type="button"
                class="w-full justify-center sm:w-auto"
            >
                Create Donation
            </flux:button>
        </div>
    </div>
</div>
