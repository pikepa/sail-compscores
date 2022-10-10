<?php

namespace App\Http\Livewire\Organisation;

use Livewire\Component;
use App\Models\Organisation;

class ManageOrganisations extends Component
{
    public $orgs;

    public function mount()
    {
        $this->orgs = Organisation::get();
    }
    public function render()
    {
        return view('livewire.organisation.manage-organisations');
    }
}
