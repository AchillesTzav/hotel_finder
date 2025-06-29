<div class="p-6">
    <div class="flex flex-col justify-between gap-4 border-2 border-slate-300 rounded-xl p-6">
        <!-- header -->
        <div>
            <span class="flex items-center justify-center text-lg font-semibold">{{ __('Stays') }}</span>
            <hr class="mt-2 border-slate-300" />
        </div>

        <div x-data="{ open: false }" class="relative">
            <!-- dropdown Button -->
            <div @click="open = !open" class="flex items-center gap-2 cursor-pointer w-fit ml-auto">
                <span>1 room, 2 travelers</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                </svg>
            </div>

            <!-- dropdown Content -->
            <div x-show="open" @click.outside="open = false" x-transition x-cloak
                class="absolute mt-2 right-0 w-48 h-48 rounded-xl border border-gray-200 bg-white shadow-lg z-10 p-4">
                <span class="text-black">Room options here</span>
            </div>
        </div>



        <!-- destination/hotel etc -->
        <div>
            <flux:input icon="magnifying-glass" placeholder="Going to" label="Destination" />
        </div>

        <div class="flex flex-row gap-4">
            <!-- check in -->
            <div class="w-full">
                <flux:input type="date" max="2999-12-31" label="Check in" />
            </div>

            <!-- check out -->
            <div class="w-full">
                <flux:input type="date" max="2999-12-31" label="Check out" />
            </div>
        </div>

        <!-- search -->
        <div class="flex justify-center">
            <flux:button>Search</flux:button>
        </div>
    </div>
</div>
