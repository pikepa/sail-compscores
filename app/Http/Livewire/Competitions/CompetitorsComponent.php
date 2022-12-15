<?php

namespace App\Http\Livewire\Competitions;

use App\Models\Competition;
use Livewire\Component;

class CompetitorsComponent extends Component
{
    public $displayForm = false;

    public $competitors;

    public function mount()
    {
        $comp = Competition::find(session('COMP_ID'));
        $this->competitors = $comp->competitors()->orderBy('created_at', 'asc')
                        ->get();
    }

    public function render()
    {
        return view('livewire.competitions.competitors-component');
    }
}
