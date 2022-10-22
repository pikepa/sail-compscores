<?php

namespace App\Http\Livewire\Clients\Home;

use App\Models\Competition;
use Livewire\Component;

class Competitions extends Component
{
    public $comps = [];
    public bool $modalFormVisible;

    public function mount($client)
    {
        $this->comps = Competition::query()
        -> where('client_id', $client)
        -> released()
        -> orderByDesc('start_date')->get();
    }

    public function render()
    {
        return view('livewire.clients.home.competitions');
    }
}
