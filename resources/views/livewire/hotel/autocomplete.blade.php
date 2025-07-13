<div class="relative">
    <!-- Search Input -->
    <flux:input wire:model.live="query" icon="magnifying-glass" placeholder="Going to" label="Destination" />

    <!-- Suggestions Dropdown -->
    @if(strlen($query) > 2 && $this->cities->isNotEmpty() && $selectedCity === '')
        <ul class="absolute z-10 bg-zinc-600 border rounded shadow mt-2 max-h-60 overflow-y-auto w-full">
            @foreach($this->cities as $city)
                <li
                    wire:click="selectCity('{{ $city->name }}')"
                    wire:key="{{ $city->id }}"
                    class="px-4 py-2 hover:bg-zinc-400 cursor-pointer text-white">
                    {{ $city->name }}
                </li>
            @endforeach
        </ul>
    @endif
</div>
