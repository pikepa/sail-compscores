<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class InviteNewUsers extends Component
{
    use AuthorizesRequests;

 public function mount(){

    $loggedUser = Auth::user();

    if (! $loggedUser->can('invite-user') ){
        return redirect('not-authorised');
    };


 }
    public function render()
    {
        return view('livewire.users.invite-new-users');
    }
}
