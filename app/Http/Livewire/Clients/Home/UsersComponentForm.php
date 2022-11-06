<?php

namespace App\Http\Livewire\Clients\Home;

use LivewireUI\Modal\ModalComponent;

class UsersComponentForm extends ModalComponent
{
    // 'sm','md','lg','xl','2xl','3xl','4xl','5xl','6xl','7xl'
    public static function modalMaxWidth(): string
    {
        return 'xl';
    }

    public function render()
    {
        return view('livewire.clients.home.users-component-form');
    }
}
