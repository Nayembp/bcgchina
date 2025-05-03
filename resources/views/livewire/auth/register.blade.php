<div class="flex flex-col gap-6">
    <x-auth-header :title="__('Create an account')" :description="__('Enter your details below to create your account')" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="register" class="flex flex-col gap-6">
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <!-- Name -->
            <flux:input
                wire:model="name"
                :label="__('Full Name')"
                type="text"
                required
                autofocus
                autocomplete="name"
                :placeholder="__('John Doe')"
            />

            <!-- Email Address -->
            <flux:input
                wire:model="email"
                :label="__('Email Address')"
                type="email"
                required
                autocomplete="email"
                placeholder="email@example.com"
            />


            <flux:input
                wire:model="phone"
                :label="__('Phone Number')"
                type="tel"
                autocomplete="tel"
                placeholder="+1234567890"
            />

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    {{ __('Profile Image') }}
                </label>
                <input
                    type="file"
                    wire:model="image"
                    accept="image/*"
                    class="block w-full text-sm text-gray-500
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-md file:border-0
                        file:text-sm file:font-semibold
                        file:bg-primary-50 file:text-primary-700
                        hover:file:bg-primary-100
                        dark:file:bg-gray-700 dark:file:text-gray-200"
                >
                @error('image') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

           
            <flux:textarea
                wire:model="current_address"
                :label="__('Current Address')"
                type="text"                
            />

          
            <flux:textarea
                wire:model="permanent_address"
                :label="__('Permanent Address')"
                type="text"
                placeholder="456 Home St, Hometown"
            />
           
            <flux:input
                wire:model="university"
                :label="__('University')"
                type="text"
                placeholder="University Name"
            />
            
        </div>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

            <flux:input
                wire:model="password"
                :label="__('Password')"
                type="password"
                required
                autocomplete="new-password"
                :placeholder="__('Password')"
            />

            <!-- Confirm Password -->
            <flux:input
                wire:model="password_confirmation"
                :label="__('Confirm Password')"
                type="password"
                required
                autocomplete="new-password"
                :placeholder="__('Confirm Password')"
            />
        </div>

        <div class="flex items-center justify-end">
            <flux:button type="submit" variant="primary" class="w-full">
                {{ __('Create account') }}
            </flux:button>
        </div>
    </form>

    <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
        {{ __('Already have an account?') }}
        <flux:link :href="route('login')" wire:navigate>{{ __('Log in') }}</flux:link>
    </div>
</div>
