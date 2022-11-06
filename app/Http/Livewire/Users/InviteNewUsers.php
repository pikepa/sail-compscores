<?php

namespace App\Http\Livewire\Users;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class InviteNewUsers extends Component
{
    use AuthorizesRequests;

    public function mount()
    {
        $loggedUser = Auth::user();

        if (! $loggedUser->can('invite-user')) {
            return redirect('not-authorised');
        }
    }

    public function render()
    {
        return view('livewire.users.invite-new-users');
    }
}
