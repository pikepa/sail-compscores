<?php

test('debugs are removed')
    ->expect(['dd', 'dump', 'var_dump'])
    ->not->toBeUsed();

test('Controllers have Controller Suffix')
    ->expect('App\Controller')
    ->toHaveSuffix('Controller');

// test('"App\Models"  are only used in Repositories')
//     ->expect('App\Models')
//     ->toOnlyBeUsedIn('App\Repositories');
