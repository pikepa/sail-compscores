<?php

namespace App\Http\Livewire\Competitions;

use Livewire\Component;
use App\Models\Competitor;
use App\Models\Competition;
use Illuminate\Support\Facades\Auth;
use App\Models\CompetitionCompetitor;

class CompetitorsComponent extends Component
{
    public $displayForm = false;

    public $competitors;
    public $comp;

    public function mount()
    {

        $this->comp = Competition::find(session('COMP_ID'));

    }

    public function render()
    {        
        $this->checkAuthority('read-competitor');

        $this->competitors = $this->comp->competitors()->orderBy('created_at', 'asc')
        ->get();

        return view('livewire.competitions.competitors-component');
    }

    public function deleteCompetitor($id)
    {        
        $this->checkAuthority('delete-competitor');
        Competitor::find($id)->competitions()->detach(session('COMP_ID'));

    }

       //Validate User is signedin and has valid Permission
       private function checkAuthority($permission)
       {
           abort_unless(Auth::check() && Auth::user()->can($permission), '403', 'Unauthorised');
       }
}
