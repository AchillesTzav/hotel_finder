<div>
    @foreach ($hotels as $hotel)
        @include('hotel.hotel-card', ['hotels' => $hotels])
    @endforeach
</div>