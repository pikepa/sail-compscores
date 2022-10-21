<?php

namespace App\Http\Livewire\Clients;

use App\Models\Client;
use Livewire\Component;

class HomePage extends Component
{
    public $client;

    public function mount($id)
    {
        $this->client = Client::find($id);
        session(['APP_PAGE_TITLE' => $this->client->name]);
    }

    public function render()
    {
        return view('livewire.clients.home-page');
    }
}
