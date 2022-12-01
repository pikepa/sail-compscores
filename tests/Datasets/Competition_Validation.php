<?php

dataset('competition_validation', [
    'competition name is required' => ['comp_name', null, 'required'],
    'competition name has Min 6  characters' => ['comp_name', 'uuuu', 'min'],
    'competition name has Max 30 characters' => ['comp_name', str_repeat('*', 31), 'max'],

    'competition venue is required' => ['comp_venue', null, 'required'],
    'competition venue is Min 6 ' => ['comp_venue', 'uuuu', 'min'],
    'competition venue is Max 30' => ['comp_venue', str_repeat('*', 31), 'max'],

    'competition type is required' => ['comp_type', null, 'required'],
    'competition type is not a valid value ' => ['comp_type', 'this is not a valid entry', 'in'],

    'start Date is required' => ['start_date', null, 'required'],
    'start Date must be a date' => ['start_date', 2022 / 01 / 33, 'date_format:Y-m-d'],

    'client_id is required' => ['client_id', null, 'required'],

    'isPublic is required' => ['isPublic', null, 'required'],
    'isPublic is boolean' => ['isPublic', 'abc', 'boolean'],

]);
