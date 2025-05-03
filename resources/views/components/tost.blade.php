<div 
    x-data="{ show: false, message: '', type: 'success' }"
    x-show="show"
    x-cloak
    x-transition
    @toast.window="
        ({ message, type = 'success' } = $event.detail);
        show = true;
        setTimeout(() => show = false, 3000);
    "
    :class="{
        'bg-green-600': type === 'success',
        'bg-red-600': type === 'error',
        'bg-blue-600': type === 'info'
    }"
    class="fixed top-5 right-5 z-50 max-w-md rounded-md px-4 py-2 shadow-lg text-white flex items-center gap-3"
>
    <!-- Icons -->
    <svg x-show="type === 'success'" class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
    </svg>
    <svg x-show="type === 'error'" class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
    </svg>
    <svg x-show="type === 'info'" class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
    </svg>

    <!-- Message -->
    <span x-text="message" class="flex-1 text-sm"></span>

    <!-- Close Button -->
    <button @click="show = false" class="text-white hover:text-gray-200 transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
</div>
