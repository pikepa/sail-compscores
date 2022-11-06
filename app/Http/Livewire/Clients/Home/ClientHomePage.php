<?php

namespace App\Http\Livewire\Clients\Home;

use App\Models\Client;

use LivewireUI\Modal\ModalComponent;

class ClientHomePage extends ModalComponent
{
    public $client;

    public function mount($id)
    {
        session(['CLIENT_ID' => $id]);
        $this->client = Client::find($id);
        session(['APP_PAGE_TITLE' => $this->client->name]);
    }

    public function render()
    {
        return view('livewire.clients.home.client-home-page');
    }
}
