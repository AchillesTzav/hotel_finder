<div class="space-y-6">
    <!-- Add Room Button -->
    <div>
        <button
            wire:click="addRoom"
            class="text-emerald-600 hover:text-emerald-700 font-semibold transition">
            + {{ __('Add Room') }}
        </button>
    </div>

    <!-- Rooms List -->
    <div class="space-y-4">
        @foreach ($rooms as $index => $room)
        <div class="bg-zinc-800 p-5 rounded-lg shadow-md space-y-4">
            <!-- Header -->
            <div class="flex items-center justify-between">
                <h3 class="text-white font-semibold text-lg">
                    {{ __('Room') }} {{ $index + 1 }}
                </h3>

                <button
                    wire:click="removeRoom({{ $index }})"
                    class="text-red-400 text-sm hover:underline transition">
                    {{ __('Remove') }}
                </button>
            </div>

            <!-- Adults Selector -->
            <div class="flex items-center justify-between text-white">
                <label class="text-sm font-medium">
                    {{ __('Adults') }}
                </label>

                <div class="flex items-center gap-2">
                    <button
                        wire:click="decrement({{ $index }})"
                        class="w-8 h-8 bg-zinc-600 text-white rounded hover:bg-zinc-700">
                        −
                    </button>

                    <input
                        type="text"
                        readonly
                        wire:model="rooms.{{ $index }}.adults"
                        class="w-12 text-center bg-zinc-700 border border-zinc-600 rounded text-white text-sm" />

                    <button
                        wire:click="increment({{ $index }})"
                        class="w-8 h-8 bg-zinc-600 text-white rounded hover:bg-zinc-700">
                        +
                    </button>
                </div>
            </div>

        </div>
        @endforeach
    </div>
</div>