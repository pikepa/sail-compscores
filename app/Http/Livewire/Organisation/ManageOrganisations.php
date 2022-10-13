<?php

namespace App\Http\Livewire\Organisation;

use App\Models\Organisation;
use Illuminate\Support\Facades\Auth;
use LDAP\Result;
use Livewire\Component;

class ManageOrganisations extends Component
{
    public $orgs;

    public $displayForm = false;

    protected $listeners = ['toggleForm'];

    public function render()
    {
        if (Auth::user()->hasRole('SuperAdmin')) {
            $this->orgs = Organisation::orderBy('name')->get();
        } else {
            $this->orgs = Organisation::where('owner_id', Auth::id())->orderBy('name')->get();
        }

        return view('livewire.organisation.manage-organisations');
    }

    public function editOrg($id)
    {   
        abort_unless(Auth::check() && Auth::user()->can('update-org'), '403', 'Unauthorised');
            $this->emit('editOrg', $id);
            $this->toggleform();
    }


    public function deleteOrg($id)
    {   
        abort_unless(Auth::check() && Auth::user()->can('delete-org'), '403', 'Unauthorised');

            Organisation::find($id)->delete();
       
    }

    public function toggleForm()
    {
        $this->displayForm = ! $this->displayForm;
    }
}
