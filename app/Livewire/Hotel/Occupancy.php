<?php

namespace App\Livewire\Hotel;

use Livewire\Attributes\On;
use Livewire\Component;

class Occupancy extends Component
{

    public $rooms = [];
    public $travellers = [];
    
    public function mount()
    {
        $this->rooms = [];

    }

    #[On('update-rooms')]
    public function updateRooms($payload)
    {
        [$index, $room] = $payload;
        $this->rooms[$index] = $room;

        $this->dispatch('addRoomsToSearch', $this->rooms);
    }

    public function addRoom()
    {
        $this->rooms[] = [];
    }


    #[On('remove-room')]
    public function removeRoom($index)
    {
        unset($this->rooms[$index]);
        $this->rooms = array_values($this->rooms); // reindex
    }


    public function render()
    {
        return view('livewire.hotel.occupancy');
    }
}
