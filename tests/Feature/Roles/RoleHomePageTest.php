<?php

    test('a user with Role "SuperAdmin" is sees all clients', function () {

          //Arrange
        loginAsUser()->assignRole('SuperAdmin');

        //Act & Assert
        $this->get(route('clients'))
          ->assertOk()
          ->assertSee('All Tenants');
    });

    test('a user with Role "ClientAdmin" is sees all their organisations', function () {

          //Arrange
        loginAsUser()->assignRole('ClientAdmin');

        //Act & Assert
        $this->get(route('clients'))
          ->assertOk()
          ->assertSee('My Organisations');
    });

    test('a user with Role "CompManager" is sees all their organisations competitions', function () {

          //Arrange

        loginAsUser()->assignRole('CompManager');

        //Act & Assert
        $this->get(route('clients'))
          ->assertOk()
          ->assertSee('My Organisations');
    });
