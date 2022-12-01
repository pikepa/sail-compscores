<?php

namespace App\Http\Livewire\Clients\Home;

use App\Models\Competition;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use LivewireUI\Modal\ModalComponent;

class CompetitionsComponentForm extends ModalComponent
{
    public $comp_name = '';

    public $comp_venue = '';

    public $start_date;

    public $released_at;

    public $comp_type = 'Individual';

    public $isPublic = 0;

    public $client_id = 0;

    public $comp_id;

    public $showEdit = false;

    protected $rules = [
        'comp_name' => 'required|min:6|max:30',
        'comp_venue' => 'required|min:6|Max:30',
        'start_date' => 'required|date_format:Y-m-d',
        'released_at' => 'nullable|date_format:Y-m-d',
        'comp_type' => 'required|in:Individual,Teams',
        'client_id' => 'required|integer|exists:clients,id',
        'isPublic' => 'required|boolean',
    ];

    // 'sm','md','lg','xl','2xl','3xl','4xl','5xl','6xl','7xl'
    public static function modalMaxWidth(): string
    {
        return 'xl';
    }

    public function mount($id = null)
    {
        if ($id) {
            $this->showEdit = true;
            $comp = Competition::find($id);
            $this->comp_id = $comp->id;
            $this->comp_name = $comp->comp_name;
            $this->comp_venue = $comp->comp_venue;
            $this->comp_type = $comp->comp_type;
            $this->start_date = $comp->start_date->format('Y-m-d');
            $this->released_at = $comp->released_at->format('Y-m-d');
        }
    }

    public function saveComp()
    {
        $this->checkAuthority('create-comp');

        $this->client_id = session('CLIENT_ID');

        $validatedData = $this->validate();

        $comp = Competition::create($validatedData);

        Session::put('message', 'Competition successfully created.');
        $this->emitUp('toggleMessage');

        return redirect(request()->header('Referer'));

        $this->closeModal();
    }

    public function updateComp($id)
    {
        $this->checkAuthority('update-comp');

        $this->client_id = session('CLIENT_ID');

        $validatedData = $this->validate();

        $comp = Competition::find($id);

        $comp->update($validatedData);

        Session::put('message', 'Competition successfully updated.');
        $this->emitUp('toggleMessage');

        return redirect(request()->header('Referer'));

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
