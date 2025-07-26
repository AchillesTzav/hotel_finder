@props(['hotel'])

<div class="flex bg-neutral-800 shadow-lg rounded-l-xl rounded-r-xl overflow-hidden mb-6">
    <!-- Hotel Image -->
    <div class="w-60 h-60">
        <img class="w-full h-full object-cover rounded-l"
            src="{{ $hotel['main_photo'] ?? $hotel['thumbnail'] }}"
            alt="{{ $hotel['name'] }}">
    </div>

    <!-- Hotel Details -->
    <div class="flex flex-col w-full">
        <div class="flex flex-col flex-1 px-6 py-2 justify-between">
            <!-- Header -->
            <div class="flex justify-between">
                <div>
                    <div class="font-bold text-xl text-gray-300">{{ $hotel['name'] }}</div>
                    <div class="flex gap-1 items-center text-sm text-gray-300">
                        <span>{{ $hotel['chain'] ?? 'Independent' }}</span>
                        <span>∙</span>
                        <span>{{ $hotel['city'] ?? '' }}, {{ $hotel['country'] ?? '' }}</span>
                    </div>
                    <span class="text-sm text-gray-300">{{ $hotel['address'] ?? '' }}</span>
                </div>
            </div>
        </div>

        <!-- Footer: Price and Actions -->
        <div class="flex justify-between items-center px-6 pb-4">
            <!-- Rating block -->
            <div class="flex flex-col items-start gap-1">
                <!-- Stars -->
                <div class="flex flex-row text-sm text-orange-600">
                    @for($i = 0; $i < ($hotel['stars'] ?? 0); $i++)
                        <svg xmlns="http://www.w3.org/2000/svg" fill="#FFD700" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="none" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                        </svg>
                    @endfor
                </div>
                
                @php
                    $ratingValue = $hotel['rating'] ?? 0;

                    $rating = match (true) {
                        $ratingValue < 2 => "", 
                        $ratingValue >= 2 && $ratingValue < 5 => "Poor",
                        $ratingValue >= 5 && $ratingValue < 7 => "Good",
                        $ratingValue >= 7 && $ratingValue < 8 => "Very good",
                        $ratingValue >= 8 && $ratingValue < 9 => "Wonderful",
                        $ratingValue >= 9 => "Exceptional",
                    };
                @endphp

                <div class="flex gap-1 items-center">
                    <span class="bg-gray-100 text-gray-500 text-sm font-semibold px-2 py-1 rounded-tl-lg rounded-br-lg">
                        {{ number_format($hotel['rating'] ?? 0, 1) }}
                    </span>
                    <div class="flex flex-col items-center justify-between gap-0">
                        <span class="text-md font-semibold text-gray-300 ">
                            {{$rating}}
                        </span>
                        <span class="text-xs text-gray-500 ">
                            ({{ $hotel['reviewCount'] ?? 0 }} reviews)
                        </span>
                    </div>
                </div>

            </div>

            <div class="flex items-center gap-6">
                <div class="flex flex-col text-right">
                    <span class="font-bold text-lg">
                        {{ $hotel['currency'] ?? 'EUR' }} 153.00
                    </span>
                    <span class="text-xs text-gray-500 uppercase">2 nights</span>
                </div>

                <button type="button"
                    class="bg-blue-700 text-white font-semibold px-4 py-2 rounded hover:bg-blue-600 transition">
                    {{ __('Select') }}
                </button>
            </div>
        </div>
    </div>
</div>