<?php

namespace App\Http\Livewire\Clients\Home;

use App\Models\Competition;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use LivewireUI\Modal\ModalComponent;

class CompetitionsComponent extends ModalComponent
{
    public $displayForm = false;

    public $comps = [];

    public function mount()
    {
        if (! session('CLIENT_ID')) {
            session(['CLIENT_ID' => request()->id]);
        }
        $this->comps = Competition::query()
        ->with('events')
        ->forsessionclient()
        ->released()
        ->orderByDesc('start_date')->get();
    }

    public function render()
    {
        return view('livewire.clients.home.competitions-component');
    }

    public function destroyComp($id)
    {
        $this->checkAuthority('delete-comp');

        $deleteComp = Competition::with('events')->find($id);

        $deleteComp->delete();

        Session::put('message', 'Competition successfully deleted.');
        $this->emitUp('toggleMessage');

        return redirect(request()->header('Referer'));
    }

    //Validate User is signedin and has valid Permission
    private function checkAuthority($permission)
    {
        abort_unless(Auth::check() && Auth::user()->can($permission), '403', 'Unauthorised');
    }
}
