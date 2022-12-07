<?php

namespace App\Http\Livewire\Competitions;

use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Facades\Session;

class EventsComponentForm extends ModalComponent
{
    public $showEdit=false;
    public $event_id;
    public $event_name;
    public $event_description;
    public $event_date;
    public $event_time;
    public $event_type;
    public $event_status = 'Pending';
    public $competition_id;

    public function mount($id = null)
    {
        if ($id) {
            $this->showEdit = true;
            $event = Event::find($id);
            $this->event_id = $event->id;
            $this->competition_id = $event->competition_id;
            $this->event_name = $event->event_name;
            $this->event_description = $event->event_description;
            $this->event_type = $event->event_type;
            $this->event_date = $event->formatted_event_date;
            $this->event_time = $event->event_time;
        }
    }
    public function render()
    {
        return view('livewire.competitions.events-component-form');
    }

    protected $rules = [
        'event_name' => 'required|min:6|max:30',
        'event_description' => 'required|min:6|max:250',
        'event_date' => 'required|date_format:Y-m-d',
        'event_time' => 'nullable',
        'event_type' => 'required|in:Max Reps,For Time,Max Wgt,Combined Wgt',
        'event_status' => 'required|in:Pending,Completed,Finalised',
        'competition_id' => 'required|integer|exists:competitions,id',
    ];
    public function saveEvent()
    {
        $this->checkAuthority('create-event');

        $this->competition_id = session('COMP_ID');

        $validatedData = $this->validate();

        $event = Event::create($validatedData);

        Session::put('message', 'Event successfully created.');
        $this->emitUp('toggleMessage');

        return redirect(request()->header('Referer'));

        $this->closeModal();
    }

    public function updateEvent($id)
    {
        $this->checkAuthority('update-event');

        $this->competition_id = session('COMP_ID');

        $validatedData = $this->validate();

        $event = Event::find($id);

        $event->update($validatedData);

        Session::put('message', 'Event successfully updated.');
        $this->emitUp('toggleMessage');

        return redirect(request()->header('Referer'));

        $this->closeModal();
    }
    //Validate User is signedin and has valid Permission
    private function checkAuthority($permission)
    {
        abort_unless(Auth::check() && Auth::user()->can($permission), '403', 'Unauthorised');
    }
}
