<?php

use App\Http\Livewire\Organisation\ManageOrganisations;
use App\Http\Livewire\Results\ManageResults;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.welcome');
    })->name('welcome');
Route::get('/profile', function () {
    return view('pages.profile');
    })->name('profile');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/organisation', ManageOrganisations::class)->name('organisation');
    Route::get('/results', ManageResults::class)->name('results');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

require __DIR__.'/auth.php';
