<?php

namespace App\Http\Livewire\Organisation;

use App\Models\Organisation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class ManageOrganisations extends Component
{
    public $displayMessage = false;

    public $displayForm = false;

    protected $listeners = [
        'toggleForm',
        'toggleMessage',
    ];

    public function mount()
    {
        session(['APP_PAGE_TITLE' => env('APP_PAGE_TITLE')]);
    }

    public function render()
    {
        if (Auth::user()->hasRole('SuperAdmin')) {
            return view('livewire.organisation.manage-organisations',
            ['orgs' => Organisation::orderBy('name')->paginate(6)]);
        } else {
            return view('livewire.organisation.manage-organisations',
            ['orgs' => Organisation::where('owner_id', Auth::id())->orderBy('name')->paginate(6)]);
        }
    }

    public function editOrg($id)
    {
        $this->checkAuthority('update-org');

        $this->emit('editOrg', $id);

        $this->toggleform();
    }

    public function deleteOrg($id)
    {
        $this->checkAuthority('delete-org');

        Organisation::find($id)->delete();

        $this->emitSelf('toggleMessage');

        Session::put('message', 'Organisation successfully deleted.');
    }

    public function toggleForm()
    {
        $this->displayForm = ! $this->displayForm;
    }

    public function toggleMessage()
    {
        $this->displayMessage = ! $this->displayMessage;
    }

    //Validate User is signedin and has valid Permission
    private function checkAuthority($permission)
    {
        abort_unless(Auth::check() && Auth::user()->can($permission), '403', 'Unauthorised');
    }
}
