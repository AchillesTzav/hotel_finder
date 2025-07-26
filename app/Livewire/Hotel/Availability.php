<?php

namespace App\Livewire\Hotel;

use Livewire\Component;
use Livewire\WithPagination;

class Availability extends Component
{
    use WithPagination;

    public $hotels = [];

    public function mount($hotels=[]) {
        $this->hotels = $hotels;
    }

    public function render()
    {
        return view('livewire.hotel.availability');
    }
}
