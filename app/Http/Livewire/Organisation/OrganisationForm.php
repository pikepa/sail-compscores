<?php

namespace App\Http\Livewire\Organisation;

use Livewire\Component;
use App\Models\Organisation;
use Illuminate\Support\Facades\Auth;

class OrganisationForm extends Component
{
    public $name ;
    public $contact_name ;
    public $contact_email ;
    public $contact_phone ;
    public $owner_id ;
    public $org_id ;
    public $edit = false;

    protected $listeners = ['editOrg'];

    protected $rules = [
        'name' => 'required|min:6',
        'contact_name' => 'required|min:6',
        'contact_email' => 'required|email',
        'contact_phone' => 'required',
        'owner_id' => 'required',
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
        $this->edit=true;

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

        // Execution doesn't reach here if validation fails.
        Organisation::create($validatedData);
        $this->emitUp('toggleForm');
    }
    public function updateOrg($id)

    {
        $validatedData = $this->validate();

        // Execution doesn't reach here if validation fails.
        Organisation::find($id)->update($validatedData);

        $this->emitUp('toggleForm');
    }
}
