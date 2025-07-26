<div class="space-y-6">
    <!-- Add Room Button -->
    <div>
        <button wire:click="addRoom" class="text-emerald-600 hover:text-emerald-700 font-semibold transition">
            + {{ __('Add Room') }}
        </button>
    </div>

    <!-- Rooms List -->
    <div class="space-y-4">
        @foreach ($rooms as $index => $room)

            <livewire:hotel.room-occupancy :index="$index" wire:key="room-{{ $index }}">


        @endforeach
    </div>
</div>