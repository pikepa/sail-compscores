<?php

namespace App\Http\Livewire\Users;

use WithPagination;
use App\Models\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ManageUsers extends Component
{

    public function render()
    {
            return view('livewire.users.manage-users', 
            [
                'users' => User::paginate(5),
            ]);
    }

}
