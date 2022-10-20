<?php

namespace App\Http\Livewire\Organisation;

use App\Models\Organisation;
use Livewire\Component;

class HomePage extends Component
{
    public $org;

    public function mount($id)
    {
        $this->org = Organisation::find($id);
        session(['APP_PAGE_TITLE' => $this->org->name]);
    }

    public function render()
    {
        return view('livewire.organisation.home-page');
    }
}
