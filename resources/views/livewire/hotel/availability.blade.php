<div>
    @foreach ($hotels as $hotel)
        <livewire:hotel.hotel-card :hotel="$hotel" />
    @endforeach
</div>