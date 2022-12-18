<?php

namespace App\Http\Livewire\Competitions;

use Livewire\Component;
use App\Models\Competition;
use Illuminate\Support\Facades\Auth;

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
        $this->checkAuthority('read-competitor');

        return view('livewire.competitions.competitors-component');
    }

       //Validate User is signedin and has valid Permission
       private function checkAuthority($permission)
       {
           abort_unless(Auth::check() && Auth::user()->can($permission), '403', 'Unauthorised');
       }
}
