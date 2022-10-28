<?php

namespace App\Http\Livewire\Clients\Home;

use App\Models\Competition;
use Livewire\Component;

class CompetitionsComponent extends Component
{
    public $comps = [];

    public bool $modalFormVisible;

    public function mount($client)
    {
        $this->comps = Competition::query()
       // GlobalScope to Client ->where('client_id', $client)
        ->released()
        ->orderByDesc('start_date')->get();
    }

    public function render()
    {
        return view('livewire.clients.home.competitions-component');
    }
}
