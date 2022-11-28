<?php

namespace App\Http\Livewire\Clients\Home;

use App\Models\Competition;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Facades\Session;

class CompetitionsComponentForm extends ModalComponent
{
    public $comp_name = '';

    public $comp_venue = '';

    public $start_date;

    public $comp_type = 'Individual';

    public $isPublic = 0;

    protected $rules = [
        'comp_name' => 'required|min:6|max:30',
        'comp_venue' => 'required|min:6|Max:30',
        'start_date' => 'required|date_format:Y-m-d',
        'comp_type' => "required|in:Individual,Teams",
    ];

    // 'sm','md','lg','xl','2xl','3xl','4xl','5xl','6xl','7xl'
    public static function modalMaxWidth(): string
    {
        return 'xl';
    }

    public function saveComp()
    {
        $this->checkAuthority('create-comp');

        $validatedData = $this->validate();

        $data = array_merge($validatedData, ['isPublic' => 0, 'client_id' => session('CLIENT_ID')]);

        $comp = Competition::create($data);

        Session::put('message', 'Competition successfully created.');
        $this->emit('toggleMessage');

        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.clients.home.competitions-component-form');
    }

    //Validate User is signedin and has valid Permission
    private function checkAuthority($permission)
    {
        abort_unless(Auth::check() && Auth::user()->can($permission), '403', 'Unauthorised');
    }
}
