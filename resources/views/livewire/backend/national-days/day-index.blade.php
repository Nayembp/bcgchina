<div>
   
    <div class="rounded-2xl border border-gray-200 bg-white pt-4 mt-2 dark:border-gray-800 dark:bg-white/[0.03]">
  
      <div class="mb-4 flex flex-col gap-2 px-5 sm:flex-row sm:items-center sm:justify-between sm:px-6">
        <div>
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                Events List
            </h3>
        </div>
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
            <form>
                <div class="relative">
                    <span class="pointer-events-none absolute top-1/2 left-4 -translate-y-1/2">
                        
                        <svg class="fill-gray-500 dark:fill-gray-400" width="20" height="20" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M3.04199 9.37381C3.04199 5.87712 5.87735 3.04218 9.37533 3.04218C12.8733 3.04218 15.7087 5.87712 15.7087 9.37381C15.7087 12.8705 12.8733 15.7055 9.37533 15.7055C5.87735 15.7055 3.04199 12.8705 3.04199 9.37381ZM9.37533 1.54218C5.04926 1.54218 1.54199 5.04835 1.54199 9.37381C1.54199 13.6993 5.04926 17.2055 9.37533 17.2055C11.2676 17.2055 13.0032 16.5346 14.3572 15.4178L17.1773 18.2381C17.4702 18.531 17.945 18.5311 18.2379 18.2382C18.5308 17.9453 18.5309 17.4704 18.238 17.1775L15.4182 14.3575C16.5367 13.0035 17.2087 11.2671 17.2087 9.37381C17.2087 5.04835 13.7014 1.54218 9.37533 1.54218Z" />
                        </svg>
                    </span>
                    <input 
                        type="text" 
                        placeholder="Search..." 
                        wire:model.live.debounce.300ms="search"
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-[42px] w-full rounded-lg border border-gray-300 bg-transparent py-2.5 pr-4 pl-[42px] text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden xl:w-[300px] dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                    />
                </div>
            </form>
    
          
            <div class="mt-3 sm:mt-0">
                
                <flux:button wire:navigate href="{{ route('national.day.create') }}" size="sm">{{ __('Add event') }}</flux:button>                  
                
            </div>
        </div>
    </div>
    
  
      <!-- events Table -->
      <div class="custom-scrollbar max-w-full overflow-x-auto px-5 sm:px-6">
        <table class="min-w-full table-auto">
          <thead class="border-y border-gray-100 py-3 dark:border-gray-800">
            <tr>
              <th class="py-3 font-normal text-left whitespace-nowrap"> Image </th>
              <th class="py-3 font-normal text-center whitespace-nowrap"> Event Name </th>
              <th class="py-3 font-normal text-center whitespace-nowrap">Theme Music</th>
              <th class="py-3 font-normal text-center whitespace-nowrap"> Note </th>        
              <th class="py-3 font-normal text-center whitespace-nowrap">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
            @forelse ($events as $event)
            
              <tr class="align-top">
                <!-- Banner Column -->
                <td class="py-4 px-3 whitespace-nowrap text-gray-800 dark:text-white">
                    <div class="flex items-center gap-3">
                        <div class="w-14 h-14 overflow-hidden rounded-md shadow border border-gray-200 dark:border-gray-700">
                            <img src="{{ asset('storage/' . $event->banner) }}" alt="{{ $event->name }} Banner" class="object-cover w-full h-full">
                        </div>
                    </div>
                </td>

                <!-- Name & Date Column -->
                <td class="py-4 px-3 text-gray-800 dark:text-white align-middle">
                    <div class="flex flex-col">
                        <span class="font-medium text-sm sm:text-base">{{ $event->name }}</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">📅 {{ \Carbon\Carbon::parse($event->date)->format('F j, Y') }}</span>
                    </div>
                </td>
          
                <td class="py-4 px-3 whitespace-nowrap text-gray-800 dark:text-white">
                    @if ($event->bg_music && Storage::disk('public')->exists($event->bg_music))
                        <audio controls class="w-48">
                            <source src="{{ asset('storage/' . $event->bg_music) }}" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>
                    @else
                        <span class="text-sm text-gray-500">No audio</span>
                    @endif
                </td>
                
                <td class="py-4 px-3 whitespace-nowrap text-gray-800 dark:text-white">
                  {{ $event->note }}
                    {{-- <flux:field variant="inline">
                      <flux:switch :checked="$event->is_active = true" wire:click="toggleStatus({{ $event->id }})" />
                        <flux:error name="status" />
                      </flux:field>                   --}}
                </td>
              
                
                <td class="py-4 px-3 whitespace-nowrap">
                  <div class="flex gap-2">
                   
                    
  
                      <flux:button size="xs" variant="primary" icon="pencil" wire:navigate href="{{ route('national.day.edit', $event->id) }}" aria-label="Edit event" />
                      
                      <flux:button size="xs" variant="danger" icon="trash"
                          x-on:click.prevent="
                              if (confirm('Are you sure you want to delete this event?')) {
                                  $wire.deleteEvent({{ $event->id }})
                            }" aria-label="Delete event" />
                            
                    
                
                
                  </div>
                </td>
              
              </tr>
            @empty
              <tr>
                <td colspan="5" class="px-4 py-4 text-center text-gray-500 dark:text-gray-400">
                  No events found.
                </td>
              </tr>
            @endforelse
  
            
          </tbody>       
        </table>  
        <div class="mt-4 mb-3">
          {{ $events->links() }}
        </div>    
      </div>
  
    
      
  
   
  </div>
  
