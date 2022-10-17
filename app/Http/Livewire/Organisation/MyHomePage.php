<?php

namespace App\Http\Livewire\Organisation;

use Livewire\Component;
use App\Models\Organisation;


class MyHomePage extends Component
{

    public function mount($id)
    {
        $org = Organisation::find($id);
        session(['APP_PAGE_TITLE' => $org->name]);
    }

    public function render()
    {
        return view('livewire.organisation.my-home-page');
    }
}
