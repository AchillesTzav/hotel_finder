<div>
    <div wire:key="room-{{ $index }}" class="dark:bg-neutral-800 p-5 rounded-lg shadow-md space-y-4">
        <div class="flex justify-between items-center">
            <h3 class="text-white font-semibold text-lg">
                {{ __('Room') }} {{ $index + 1 }}
            </h3>
            <button wire:click="removeRoom({{ $index }})" class="text-red-500">{{ __('Remove') }}</button>
        </div>

        <div x-data="{open: false}" class="text-white">
            <label>{{ __('Travellers') }}</label>
            @if (isset($selected))
                <div class="grid grid-cols-4 gap-2">
                    @foreach ($selected as $user)
                        <div wire:click="removeUser({{$user->id}})">
                            <x-custom.user-pill :user="$user" />
                        </div>
                    @endforeach
                </div>
            @endif

            <input type="text" wire:model.live="search" @click="open = true"
                placeholder="{{ count($selected) ? count($selected) . ' selected' : 'Select travellers' }}"
                class="text-white placeholder:text-sky-400 p-1 m-2 rounded w-full" />

            <div x-show="open" @click.outside="open = false" class="flex flex-col items-center justify-center gap-2">
                
                    @foreach ($users as $user)
                        <div wire:click="selectUser({{$user->id}})">
                            <x-custom.user-pill :user="$user" />
                        </div>
                    @endforeach
                
            </div>
        </div>
    </div>
</div>