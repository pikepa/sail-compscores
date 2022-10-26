<?php

use App\Http\Livewire\Clients\HomePage;
use App\Http\Livewire\Clients\ManageClients;
use App\Http\Livewire\Results\ManageResults;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.welcome');
})->name('welcome');
Route::get('/profile', function () {
    return view('pages.profile');
})->name('profile');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/client/home/{id}', HomePage::class)->name('client-home');
    Route::get('/client', ManageClients::class)->name('clients');
    Route::get('/competitions', ManageClients::class)->name('competitions');
    Route::get('/events', ManageClients::class)->name('events');

    Route::get('/results', ManageResults::class)->name('results');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

require __DIR__.'/auth.php';
