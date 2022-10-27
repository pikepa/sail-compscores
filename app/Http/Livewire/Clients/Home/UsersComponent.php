<?php

namespace App\Http\Livewire\Clients\Home;

use App\Models\User;
use Livewire\Component;

class UsersComponent extends Component
{
    public $client_users = [];
    public bool $modalFormVisible;

    public function mount($client)
    {
        $this->client_users = User::query()
        ->where('client_id', $client)
        ->orderByDesc('created_at')->get();
    }

    public function render()
    {
        return view('livewire.clients.home.users-component');
    }
}
