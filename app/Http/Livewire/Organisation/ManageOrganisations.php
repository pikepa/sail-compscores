<?php

namespace App\Http\Livewire\Organisation;

use App\Models\Organisation;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ManageOrganisations extends Component
{
    public $orgs;

    public $displayForm = false;

    protected $listeners = ['displayForm'];

    public function render()
    {
        if (Auth::user()->hasRole('SuperAdmin')) {
            $this->orgs = Organisation::orderBy('name')->get();
        } else {
            $this->orgs = Organisation::where('owner_id', Auth::id())->orderBy('name')->get();
        }

        return view('livewire.organisation.manage-organisations');
    }

    public function displayForm()
    {
        $this->displayForm = ! $this->displayForm;
    }
}
