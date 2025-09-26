<x-layouts.app :title="__('Availability')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div>
            <div
                class="relative h-full flex-1 overflow-hidden rounded-xl dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-700 p-4">
                <div class="text-xl font-semibold mb-4">
                    {{ __('Find your next stay') }}
                </div>
                <livewire:hotel.availability :search_id="$search_id" />
            </div>
        </div>
    </div>
</x-layouts.app>