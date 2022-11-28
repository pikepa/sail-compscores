<?php

namespace App\Http\Livewire\Clients\Home;

use App\Models\Competition;
use LivewireUI\Modal\ModalComponent;

class CompetitionsComponent extends ModalComponent
{
    public $displayForm = false;

    public $comps = [];

    public function mount()
    {
        if(!session('CLIENT_ID')){
            session(['CLIENT_ID' => request()->id]);
        }
// dd(session('CLIENT_ID'));

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
