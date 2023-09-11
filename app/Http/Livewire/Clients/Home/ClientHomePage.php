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
        session(['COMP_ID' => ""]);

    }

    public function render()
    {
        $this->client = Client::find(session('CLIENT_ID'));
        session(['APP_PAGE_TITLE' => $this->client->name]);
        
        return view('livewire.clients.home.client-home-page');
    }
}
