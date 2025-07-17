<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 dark:bg-neutral-900">
            <livewire:search />
        </div>


        <div>
            <div
                class="relative h-full flex-1 overflow-hidden rounded-xl dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-700 p-4">
                <div class="text-xl font-semibold mb-4">
                    {{ __('Find your next destination') }}
                </div>

                <div class="flex flex-wrap justify-center gap-6">
                    @foreach(['Italy', 'Greece', 'Japan', 'Hungary', 'Poland', 'Croatia', 'Korea'] as $country) 
                    <div
                        class="flex items-center justify-center relative h-80 w-48 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                        <img src="https://picsum.photos/600/337" alt="Placeholder"
                            class="absolute inset-0 h-full w-full object-cover" />
                        <span class="z-10 text-black font-bold text-xl">{{ $country }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>


        <div>
            <livewire:hotel.quick-search />
        </div>
    </div>
</x-layouts.app>