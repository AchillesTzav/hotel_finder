<div>
    <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-6 bg-white dark:bg-neutral-900">
        <div class="mb-6 space-y-2">
            <p class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ __("Can't decide where to go?") }}</p>
            <p class="text-neutral-600 dark:text-neutral-400">
                {{ __("Make a quick search based on the country and get surprised by the results!") }}
            </p>
        </div>

        <div class="grid gap-4 md:grid-cols-3">
            @foreach($random_countries as $country)
            <div
                class="flex items-center space-x-4 rounded-xl border border-neutral-200 dark:border-neutral-700 p-4 shadow-sm hover:shadow-lg transition-shadow duration-300 bg-gray-50 dark:bg-neutral-800">

                <img
                    src="{{ asset('storage/flags/' . strtolower($country->code) . '.webp') }}"
                    alt="{{ $country->name }} flag"
                    class="w-14 h-9 rounded-md object-cover flex-shrink-0"
                    loading="lazy" />

                <span class="flex-1 text-lg font-semibold text-gray-900 dark:text-gray-100">
                    {{ $country->name }}
                </span>

                <div class="flex space-x-2">
                    <button
                        type="button"
                        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-1 text-white rounded-md text-sm font-medium transition">
                        {{ __('View') }}
                    </button>

                    <button
                        wire:click="quickSearch('{{$country->code}}')"
                        type="button"
                        class="px-4 py-2 bg-gray-300 hover:bg-gray-400 focus:ring-2 focus:ring-gray-400 focus:ring-offset-1 text-gray-800 rounded-md text-sm font-medium transition dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
                        {{__('Quick search')}}
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>