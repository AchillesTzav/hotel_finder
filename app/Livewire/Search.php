<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class Search extends Component
{
    public function render()
    {
        return view('livewire.search');
    }

    #[On('getDataEvent')]
    public function test($payload) {
    
        dd($payload);
    }
}
