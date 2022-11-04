<?php

namespace App\Http\Livewire\Clients\Home;

use App\Models\Client;
use Livewire\Component;

class UsersComponent extends Component
{
    public $client_users = [];

    public bool $modalFormVisible;

    public function mount()
    {
        $this->client_users = Client::find(session('CLIENT_ID'))
                ->client_users;
        //   ->orderByDesc('created_at');
    }

    public function render()
    {
        return view('livewire.clients.home.users-component');
    }
}
