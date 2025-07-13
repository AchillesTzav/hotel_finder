<?php

namespace App\Livewire\Hotel;

use Livewire\Component;

class Occupancy extends Component
{

    public $rooms = [
        ['adults' => 1],
    ];


    public function addRoom()
    {
        if (count($this->rooms) < 4) {

            $this->rooms[] = ['adults' => 1];
        }
    }

    public function removeRoom($index)
    {
        unset($this->rooms[$index]);
        $this->rooms = array_values($this->rooms);
    }

    public function render()
    {
        return view('livewire.hotel.occupancy');
    }


    public function increment($index)
    {
        if (isset($this->rooms[$index]['adults']) && $this->rooms[$index]['adults'] < 14) {
            $this->rooms[$index]['adults']++;
        }

        //dispatch to search
    }

    public function decrement($index)
    {
        if (isset($this->rooms[$index]['adults']) && $this->rooms[$index]['adults'] > 1) {
            $this->rooms[$index]['adults']--;
        }

        //dispatch to search
    }
}
