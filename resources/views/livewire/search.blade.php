<div class="p-6">
    <div class="flex flex-col justify-between gap-4 dark:bg-neutral-900   rounded-xl p-6">
        <!-- header -->
        <div>
            <span class="flex items-center justify-center text-lg font-semibold">{{ __('Stays') }}</span>
            <hr class="mt-2 border-neutral-700" />
        </div>

        <!-- destination/hotel etc -->
        <div class="flex items-center justify-between gap-4 ">
            <div class="w-2/3">
                <livewire:hotel.autocomplete />
            </div>

           <div wire:ignore class="w-1/3">
                <flux:input id="flatpickr-date" label="Check in - Check out" />
            </div>
        </div>



        <div>
            <livewire:hotel.occupancy /> 
        </div>
 

        <!-- search -->
        <div class="flex justify-center">
            <flux:button wire:click="search">{{__('Search')}}</flux:button>
        </div>
    </div>
</div>
