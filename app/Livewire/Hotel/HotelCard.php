<?php

namespace App\Livewire\Hotel;

use Livewire\Component;

class HotelCard extends Component
{
    public $hotel;
    public function mount($hotel) {
        $this->hotel = $hotel;
    } 
    
    public function render()
    {
        return view('livewire.hotel.hotel-card');
    }
}
