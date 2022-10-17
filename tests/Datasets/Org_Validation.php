<?php
 
dataset('org_validation', [
    'name is required' => ['name', null, 'required'],
    'name is Min 6 ' => ['name', 'uuuu', 'min'],
    'name is Max 30' => ['name', str_repeat('*', 31), 'max'],
    
    'contact_name is required' => ['contact_name', null, 'required'],
    'contact_name is Min 6 ' => ['contact_name', 'uuuu', 'min'],
    'contact_name is Max 30' => ['contact_name', str_repeat('*', 31), 'max'],

    'contact_email is required' => ['contact_email', null, 'required'],
    'contact_email is not an email ' => ['contact_email', 'this is not an email', 'email'],

    'contact_phone is required' => ['contact_phone', null, 'required'],
    'contact_phone is starts with +' => ['contact_phone', 'z', 'starts_with'],
    'contact_phone is Min 13 ' => ['contact_phone', '+11 2131', 'min'],
    'contact_phone is Max 16' => ['contact_phone', str_repeat('+', 31), 'max'],

    'owner_id is required'=> ['owner_id', null, 'required'],
    'owner_id is an integer'=> ['owner_id', 'not a integer', 'integer'],

]);