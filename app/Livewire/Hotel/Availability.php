<?php

namespace App\Livewire\Hotel;

use App\Models\Hotels\Hotel;
use App\Models\Hotels\Search;
use Livewire\Component;
use Livewire\WithPagination;

class Availability extends Component
{
    use WithPagination;

    public $hotels = [];

    public function mount($search_id)
    {
        $search = Search::find($search_id);

        $this->hotels = Hotel::where('city', $search->city)->get();
    }

    /**
     * @todo poll db for results
     * when fetch stop
     */
    public function render()
    {
        return view('livewire.hotel.availability');
    }
}
