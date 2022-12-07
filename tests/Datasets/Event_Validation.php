<?php

dataset('event_validation', [
    'name is required' => ['event_name', null, 'required'],
    'name is Min 6 ' => ['event_name', 'uuuu', 'min'],
    'name is Max 30' => ['event_name', str_repeat('*', 31), 'max'],

    'event description is required' => ['event_description', null, 'required'],
    'event description is Min 6 ' => ['event_description', 'uuuu', 'min'],
    'event description is Max 30' => ['event_description', str_repeat('*', 251), 'max'],

    'event_date is required' => ['event_date', null, 'required'],
    'event_date is not a date ' => ['event_date', 'this is not a date', 'date_format:Y-m-d'],

    'event_type is required' => ['event_type', null, 'required'],
    'event_type is in valid range' => ['event_type', 'holiday', 'in'],

    'event_status is required' => ['event_status', null, 'required'],
    'event_status is in valid range' => ['event_status', 'Wrong Value', 'in'],

    'competition_id is required' => ['competition_id', null, 'required'],

]);
