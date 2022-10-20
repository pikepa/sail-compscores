<?php

namespace App\Http\Livewire\Organisation;

use App\Models\Organisation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class OrganisationForm extends Component
{
    public $name;

    public $contact_name;

    public $contact_email;

    public $contact_phone;

    public $owner_id;

    public $org_id;

    public $edit = false;

    protected $listeners = ['editOrg'];

    protected $rules = [
        'name' => 'required|min:6|max:30',
        'contact_name' => 'required|min:6|Max:30',
        'contact_email' => 'required|email',
        'contact_phone' => 'required|starts_with:+|min:13|max:16',
        'owner_id' => 'required|integer',
    ];

    public function mount()
    {
        $this->owner_id = Auth::user()->id;
    }

    public function render()
    {
        return view('livewire.organisation.organisation-form');
    }

    public function editOrg($id)
    {
        $this->checkAuthority('update-org');

        $this->edit = true;

        $org = Organisation::find($id);
        $this->org_id = $id;
        $this->name = $org->name;
        $this->contact_name = $org->contact_name;
        $this->contact_email = $org->contact_email;
        $this->contact_phone = $org->contact_phone;
    }

    public function saveOrg()
    {
        $validatedData = $this->validate();

        $this->checkAuthority('create-org');

        Organisation::create($validatedData);

        Session::put('message', 'Organisation successfully created.');
        $this->emitUp('toggleMessage');

        $this->emitUp('toggleForm');
    }

    public function updateOrg($id)
    {
        $validatedData = $this->validate();

        $this->checkAuthority('update-org');

        Organisation::find($id)->update($validatedData);

        $this->emitUp('toggleForm');
        $this->emitUp('toggleMessage');

        Session::put('message', 'Organisation successfully updated.');
    }

    //Validate User is signedin and has valid Permission
    private function checkAuthority($permission)
    {
        abort_unless(Auth::check() && Auth::user()->can($permission), '403', 'Unauthorised');
    }
}
