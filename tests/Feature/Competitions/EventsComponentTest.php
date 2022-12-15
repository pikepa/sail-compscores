<?php

use App\Http\Livewire\Competitions\EventsComponent;
use App\Models\Competition;
use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

beforeEach(function () {
    //Arrange
    $this->comp = Competition::factory()->create();
    $this->event = Event::factory()->create([
        'competition_id' => $this->comp->id,
    ]);
});

test('A ClientAdmin can display the events component page and content', function () {
    //Act & Assert
    loginAsUser()->assignRole('ClientAdmin');

    $this->withSession(['COMP_ID' => $this->comp->id]);

    Livewire::test(EventsComponent::class)
        ->assertSee('Event Name')
        ->assertSee('Event Date')
        ->assertSee('Scheduled')
        ->assertSee('Type')
        ->assertSee('Status')
        ->assertSee('Add New')
        ->assertSee($this->event->event_name)
        ->assertSee($this->event->sched_dateTime)
        ->assertSee($this->event->event_type)
        ->assertSee($this->event->event_status);
});

test('it shows competitions by start date & time ascending', function () {
    // set up two competitions one starting before the other
    $lastEvent = Event::factory()->create([
        'competition_id' => $this->comp->id,
        'event_date' => '2022-11-19',
        'event_time' => '17:30',
    ]);
    $earliestEvent = Event::factory()->create([
        'competition_id' => $this->comp->id,
        'event_date' => '2022-11-19',
        'event_time' => '09:30',
    ]);

    //Act and assert
    $this->withSession(['COMP_ID' => $this->comp->id]);

    loginAsUser()->assignRole('ClientAdmin');

    Livewire::test(EventsComponent::class, [$this->comp->id])
        ->assertSeeTextInOrder([
            $earliestEvent->event_name,
            $lastEvent->event_name,
        ]);
});
