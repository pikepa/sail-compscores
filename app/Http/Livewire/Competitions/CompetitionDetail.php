<?php

namespace App\Http\Livewire\Competitions;

use App\Models\Competition;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CompetitionDetail extends Component
{
    public $comp;

    public function mount($id)
    {
        $this->checkAuthority('read-comp');

        $this->comp = Competition::find($id);
        session(['APP_COMP_TITLE' => $this->comp->comp_name]);
        session(['COMP_ID' => $id]);
    }

    public function render()
    {
        return view('livewire.competitions.competition-detail');
    }

    //Validate User is signedin and has valid Permission
    private function checkAuthority($permission)
    {
        abort_unless(Auth::check() && Auth::user()->can($permission), '403', 'Unauthorised');
    }
}
