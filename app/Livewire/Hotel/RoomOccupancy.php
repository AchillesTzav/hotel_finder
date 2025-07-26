<?php

namespace App\Livewire\Hotel;

use Livewire\Component;
use App\Models\User;

class RoomOccupancy extends Component
{

    public $index;
    //public $users = [];
    public $search = '';
    public $selected = [];
    public $room = [];

    public function mount($index)
    {
        $this->index = $index;

    }

    public function selectUser($user_id)
    {
        $user = User::find($user_id);
        if (!in_array($user, $this->selected)) {
            $this->room[] = $user_id;
            $this->selected[] = $user;
        }


        $this->dispatch('update-rooms', [$this->index, $this->room]);
    }

    public function removeUser($user_id)
    {
        $this->selected = array_values(array_filter($this->selected, function ($user) use ($user_id) {
            return $user->id != $user_id;
        }));

        $this->room = array_values(array_filter($this->room, function ($id) use ($user_id) {
            return $id != $user_id;
        }));
    }

    public function removeRoom($index)
    {
        $this->dispatch('remove-room', $index);

    }
    public function render()
    {


        return view('livewire.hotel.room-occupancy', [
            'users' => $this->fetchUsers(),
        ]);
    }

    public function fetchUsers()
    {
        if (strlen($this->search) <= 1) {
            return []; 
        }

        return User::where(function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%');
        })
            ->take(10)
            ->get();
    }
}



