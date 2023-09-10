<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Livewire\Component;

class ManageUsers extends Component
{
    public function mount()
    {
        // dd('im here');
    }
    public function render()
    {
        return view('livewire.users.manage-users',
            [
                'users' => User::paginate(5),
            ]);
    }
}
