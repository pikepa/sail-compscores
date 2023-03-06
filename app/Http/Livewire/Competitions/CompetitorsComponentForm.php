<?php

namespace App\Http\Livewire\Competitions;

use App\Models\CompetitionCompetitor;
use App\Models\Competitor;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Facades\Session;

class CompetitorsComponentForm extends ModalComponent
{
    public $showEdit = false;
    public $first_name;
    public $surname;
    public $email;
    public $gender;
    public $competitor_dob;
    public $competitor_id;


    protected $rules = [
        'first_name' => 'required|min:3|max:30',
        'surname' => 'required|min:3|max:250',
        'email' => 'required|email|unique:competitors',
        'gender' => 'required|in:Male,Female',
        'competitor_dob' => 'required|date_format:Y-m-d',
    ];

    public function mount($id = null)
    {
        if ($id) {
            $this->showEdit = true;
            $competitor = Competitor::find($id);
            $this->first_name = $competitor->first_name;
            $this->surname = $competitor->surname;
            $this->gender = $competitor->gender;
            $this->competitor_dob = $competitor->competitor_dob;
            $this->email = $competitor->email;
            $this->competitor_id = $competitor->id;
        }
    }

    public function render()
    {
        return view('livewire.competitions.competitors-component-form');
    }

    public function saveCompetitor()
    {
        $this->checkAuthority('create-competitor');

        $this->competition_id = session('COMP_ID');

        $validatedData = $this->validate();
        
        //create Competitor with link to Competition
        Competitor::create($validatedData)
            ->competitions()->attach($this->competition_id);

        Session::put('message', 'Competitor successfully created.');
        $this->emitUp('toggleMessage');

        return redirect(request()->header('Referer'));

        $this->closeModal();
    }

    public function updateCompetitor($id)
    {
        $this->checkAuthority('update-competitor');

        $validatedData = $this->validate();

        $competitor = Competitor::find($id);

        $competitor->update($validatedData);

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
