<?php

use App\Models\User;

it('adds given super user', function () {
    // Assert
    $this->assertDatabaseCount(User::class, 0);

    // Act
    $this->artisan('db:seed UserSeeder');

    // Assert
    $this->assertDatabaseCount(User::class, 8);
    $this->assertDatabaseHas(User::class, ['name' => 'Peter Pike', 'email' => 'pikepeter@gmail.com']);
});
