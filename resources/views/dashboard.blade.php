<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <livewire:search />
        </div>

        <div>
            <div
                class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-4">
                <div>
                    {{ __('Find your next destination') }}
                </div>

                <div class="grid auto-rows-min gap-4 md:grid-cols-3">

                    <div
                        class="flex items-center justify-center relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                        <img src="https://picsum.photos/600/337" alt="Placeholder"
                            class="absolute inset-0 h-full w-full object-cover" />
                        <span class="z-10 text-black font-bold text-xl ">{{ __('Italy') }}</span>
                    </div>
                    <div
                        class="flex items-center justify-center  relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                        <img src="https://picsum.photos/600/337" alt="Placeholder"
                            class="absolute inset-0 h-full w-full object-cover" />
                        <span class="z-10 text-black font-bold text-xl ">{{ __('Greece') }}</span>
                    </div>
                    <div
                        class="flex items-center justify-center  relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                        <img src="https://picsum.photos/600/337" alt="Placeholder"
                            class="absolute inset-0 h-full w-full object-cover" />
                        <span class="z-10 text-black font-bold text-xl ">{{ __('Japan') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
