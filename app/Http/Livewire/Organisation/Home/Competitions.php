<?php

namespace App\Http\Livewire\Organisation\Home;

use App\Models\Competition;
use Livewire\Component;

class Competitions extends Component
{
    public $comps = [];

    public function mount($org)
    {
        $this->comps = Competition::where('org_id', $org)->get();
    }

    public function render()
    {
        return view('livewire..organisation.home.competitions');
    }
}
