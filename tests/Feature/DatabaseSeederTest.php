<?php

use App\Models\User;
use App\Models\Client;
use App\Models\Competition;

it('adds nominated users (SuperAdmin, Client Admin, Competition Manager, and two comp Users', function () {
    // Assert
    $this->assertDatabaseCount(User::class, 0);

    // Act
    $this->artisan('db:seed UserSeeder');

    // Assert
    $this->assertDatabaseCount(User::class, 5);
    $this->assertDatabaseHas(User::class, ['name' => 'Peter Pike', 'email' => 'pikepeter@gmail.com']);
    $this->assertDatabaseHas(User::class, ['name' => 'Client Admin', 'email' => 'clientadmin@gmail.com']);
    $this->assertDatabaseHas(User::class, ['name' => 'Competition Manager', 'email' => 'compmanager@gmail.com']);
    $this->assertDatabaseHas(User::class, ['name' => 'Comp User 1', 'email' => 'compuser1@gmail.com']);
    $this->assertDatabaseHas(User::class, ['name' => 'Comp User 2', 'email' => 'compuser2@gmail.com']);
});

it('adds two Clients owned by Client Adminb', function () {
    // Assert
    $this->assertDatabaseCount(Client::class, 0);

    // Act
    $this->artisan('db:seed ClientSeeder');

    // Assert
    $this->assertDatabaseCount(Client::class, 2);
    $this->assertDatabaseHas(Client::class, ['name' => 'Urban Energy Southport', 'owner_id' => '2']);
    $this->assertDatabaseHas(Client::class, ['name' => 'Urban Energy Miami' , 'owner_id' => '2']);
});


    it('adds four competitions for each client each with 5 events', function () {

          //Arrange
          Client::factory()->create();
          $this->assertDatabaseCount(Competitions::class, 0);
          $this->assertDatabaseCount(Events::class, 0);
          $this->assertDatabaseCount(Competitors::class, 0);
          
          //Act
          $this->artisan('db:seed CompetitionSeeder');
          
          //Assert
          $this->assertDatabaseCount(Competitions::class, 4);
          $this->assertDatabaseCount(Events::class, 20);
          $this->assertDatabaseCount(Competitors::class, 40);
          

        });

