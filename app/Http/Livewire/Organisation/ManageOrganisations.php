<?php

namespace App\Http\Livewire\Organisation;

use Livewire\Component;
use App\Models\Organisation;
use Illuminate\Support\Facades\Auth;

class ManageOrganisations extends Component
{
    public $orgs;

    public function mount()
    {
        if(Auth::user()->hasRole('SuperAdmin'))
        {
            $this->orgs = Organisation::orderBy('name')->get();

        } else {       
            $this->orgs = Organisation::where('owner_id',Auth::id())->orderBy('name')->get();
        }
    }

    public function render()
    {
        return view('livewire.organisation.manage-organisations');
    }
}
