<?php

dataset('competitor_validation', [
    'first_name is required' => ['first_name', null, 'required'],
    'first_name is Min 3 ' => ['first_name', 'uu', 'min'],
    'first_name is Max 30' => ['first_name', str_repeat('*', 31), 'max'],

    'surname is required' => ['surname', null, 'required'],
    'surname is Min 3 ' => ['surname', 'uu', 'min'],
    'surname is Max 30' => ['surname', str_repeat('*', 251), 'max'],

    'competitor_dob is required' => ['competitor_dob', null, 'required'],
    'competitor_dob is not a date ' => ['competitor_dob', 'this is not a date', 'date_format:Y-m-d'],

    'gender is required' => ['gender', null, 'required'],
    'gender is in valid range' => ['gender', 'holiday', 'in'],

    'email is required' => ['email', null, 'required'],
    'email is not a valid' => ['email', 'Wrong Value', 'email'],

]);
