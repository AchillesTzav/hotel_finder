@props(['hotel'])

<div class="flex bg-neutral-800 shadow-lg rounded-l-xl overflow-hidden mb-6">
    <!-- Hotel Image -->
    <div class="w-60 h-60">
        <img
            class="w-full h-full object-cover rounded-l"
            src="{{ $hotel['main_photo'] ?? 'https://via.placeholder.com/300x200?text=No+Image' }}"
            alt="{{ $hotel['name'] }}">
    </div>

    <!-- Hotel Details -->
    <div class="flex flex-col w-full">
        <div class="flex flex-col flex-1 px-6 py-2 justify-between">
            <!-- Header -->
            <div class="flex justify-between">
                <div>
                    <div class="font-bold text-xl text-gray-700">{{ $hotel['name'] }}</div>
                    <div class="flex gap-1 items-center text-sm text-gray-700">
                        <span>{{ $hotel['chain'] ?? 'Independent' }}</span>
                        <span>∙</span>
                        <span>{{ $hotel['city'] ?? '' }}, {{ $hotel['country'] ?? '' }}</span>
                    </div>
                </div>

                <!-- Rating block -->
                <div class="flex flex-col items-end gap-2">
                    <div class="flex gap-1 items-center">
                        <span class="bg-gray-100 text-gray-500 text-sm font-semibold px-2 py-1 rounded">
                            {{ number_format($hotel['rating'] ?? 0, 1) }}
                        </span>
                        <span class="text-xs text-gray-500">
                            ({{ $hotel['reviewCount'] ?? 0 }} reviews)
                        </span>
                    </div>

                    <!-- Stars -->
                    <div class="text-sm text-orange-600">
                        @for($i = 0; $i < ($hotel['stars'] ?? 0); $i++)
                            <i class="fa fa-fw fa-star"></i>
                            @endfor
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer: Price and Actions -->
        <div class="flex justify-between items-center px-6 pb-4">
            <div class="text-xs text-gray-600">
                <i class="fa fa-fw fa-calendar text-green-700"></i>
                Free cancellation
            </div>

            <div class="flex items-center gap-6">
                <div class="flex flex-col text-right">
                    <span class="font-bold text-lg">
                        {{ $hotel['currency'] ?? 'USD' }} 153.00
                    </span>
                    <span class="text-xs text-gray-500 uppercase">2 nights</span>
                </div>

                <button
                    type="button"
                    class="bg-blue-700 text-white font-semibold px-4 py-2 rounded hover:bg-blue-600 transition"
                    wire:click.prevent="goToAdditionalRates('{{ $hotel['id'] }}')">
                    See availability
                </button>
            </div>
        </div>
    </div>
</div>