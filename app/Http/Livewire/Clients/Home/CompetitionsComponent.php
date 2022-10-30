<?php

namespace App\Http\Livewire\Clients\Home;

use App\Models\Competition;
use Livewire\Component;

class CompetitionsComponent extends Component
{
    public $comps = [];

    public bool $modalFormVisible;

    public function mount()
    {
        $this->comps = Competition::query()
        ->forsessionclient()
        ->released()
        ->orderByDesc('start_date')->get();
    }

    public function render()
    {
        return view('livewire.clients.home.competitions-component');
    }
}
