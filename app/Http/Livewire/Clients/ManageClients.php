<?php

namespace App\Http\Livewire\Clients;

use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class ManageClients extends Component
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
            return view('livewire.clients.manage-clients',
                ['clients' => Client::orderBy('name')->paginate(6)]);
        } else {
            return view('livewire.clients.manage-clients',
                ['clients' => Client::where('owner_id', Auth::id())->orderBy('name')->paginate(6)]);
        }
    }

    public function editOrg($id)
    {
        $this->checkAuthority('update-org');

        $this->emit('editOrg', $id);

        $this->toggleform();
    }

    public function deleteClient($id)
    {
        $this->checkAuthority('delete-org');

        Client::find($id)->delete();

        $this->emitSelf('toggleMessage');

        Session::put('message', 'Client successfully deleted.');
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
