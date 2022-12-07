<?php

namespace App\Http\Livewire\Competitions;

use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Facades\Session;

class EventsComponent extends ModalComponent
{
    public $displayForm=false;
    public $events;

    public function mount($comp_id)
    {

        session(['COMP_ID' => $comp_id]);

        $this->events = Event::where('competition_id',$comp_id)
                        ->orderBy('event_date', 'asc')
                        ->orderBy('event_time', 'asc')->get();
    }
    public function render()
    {
        return view('livewire.competitions.events-component');
    }

    public function destroyEvent($id)
    {
        $this->checkAuthority('delete-event');

        $deleteEvent = Event::find($id);

        $deleteEvent->delete();

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
