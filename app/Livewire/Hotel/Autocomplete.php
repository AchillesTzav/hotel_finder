<?php

namespace App\Livewire\Hotel;

use Livewire\Component;
use App\Models\Hotels\City;

class Autocomplete extends Component
{

    public $query = '';
    public $selectedCity = '';

    public function selectCity($city_name) {
        $this->selectedCity = $city_name;
        $this->query = $city_name;

        // dispatch to search component
        $this->dispatch('getDataEvent', $this->query);
    }

    public function getCitiesProperty() {
        $this->selectedCity = '';
        if (strlen($this->query) > 2) {
            return City::where('name', 'like', '%' . $this->query . '%')->get();  
        } 
        return collect();
    }


    public function render()
    {
        return view('livewire.hotel.autocomplete');
    }

}
