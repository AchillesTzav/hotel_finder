<?php

namespace App\Livewire\Hotel;

use Livewire\Component;

class Availability extends Component
{
    public $hotels = [];


    public function mount($hotels=[]) {
        $this->hotels = $hotels;
    }

    public function render()
    {
        return view('livewire.hotel.availability');
    }
}
