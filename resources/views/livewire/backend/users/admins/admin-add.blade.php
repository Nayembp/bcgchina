<div class="max-w-6xl mx-auto space-y-6">
    <!-- Header Section -->
    <div class="mb-4 flex flex-col gap-2 px-5 sm:flex-row sm:items-center sm:justify-between sm:px-6">
        <div>
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                Add New Admin
            </h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Create a new admin user with a specific role
            </p>
        </div>

        <!-- Back Button -->
        <div class="flex items-center gap-2 mt-3 sm:mt-0">
            <a wire:navigate href="{{ route('admin.index') }}" class="flex items-center text-sm text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                <span>Back</span>
            </a>
        </div>
    </div>


    <!-- Form Section -->
    <div class="space-y-4 px-5 sm:px-6">
        <!-- Name Field -->
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
                <flux:input 
                    wire:model="name" 
                    label="Full Name" 
                    placeholder="Enter full name"
                    required
                />
                
            </div>

            <div>
                <flux:input 
                    wire:model="phone" 
                    label="Phone Number" 
                    placeholder="Enter phone number"
                    required
                />
                
            </div>

            <div>
                <flux:input 
                    wire:model="university" 
                    label="University Name" 
                    placeholder="Enter university name"
                    required
                />
                
            </div>

            <div>
                <flux:input 
                    wire:model="current_address" 
                    label="Current Address" 
                    placeholder="Enter current address"
                    required
                />
                
            </div>

            <div>
                <flux:input 
                    wire:model="permanent_address" 
                    label="Permanent Address" 
                    placeholder="Enter Permanent address"
                    required
                />
                
            </div>
            
            <!-- Email Field -->
            <div>
                <flux:input 
                    type="email" 
                    wire:model="email" 
                    label="Email Address" 
                    placeholder="Enter email address"
                    required
                />
                
            </div>
        </div>

        <!-- Password Fields -->
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
                <flux:input 
                    type="password" 
                    wire:model="password" 
                    label="Password" 
                    placeholder="Enter password"
                    required
                />
                {{-- @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror --}}
            </div>
            <div>
                <flux:input 
                    type="password" 
                    wire:model="password_confirmation" 
                    label="Confirm Password" 
                    placeholder="Confirm password"
                    required
                />
            </div>
        </div>

        <!-- Roles Selection -->
        <div class="space-y-2">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Role *
            </label>
            <div class="space-y-2">
                @foreach($roles as $role)
                    <label class="flex items-center space-x-2">
                        <input 
                            type="radio" 
                            wire:model="selectedRole"
                            value="{{ $role->name }}"
                            class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 dark:border-gray-600 dark:bg-gray-700"
                        >
                        <span class="text-gray-700 dark:text-gray-300">{{ $role->name }}</span>
                    </label>
                @endforeach
            </div>
            @error('selectedRole')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit Button -->
        <div class="pt-4">
            <flux:button 
                wire:click="save" 
                type="button"
                class="w-full justify-center sm:w-auto"
            >
                Create Admin
            </flux:button>
        </div>
    </div>
</div>