<?php

namespace App\Http\Livewire\Organisation;

use Livewire\Component;
use App\Models\Organisation;


class HomePage extends Component
{
    Public $org;

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
