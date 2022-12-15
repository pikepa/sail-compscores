<?php

use App\Http\Livewire\Clients\Home\ClientHomePage;
use App\Http\Livewire\Clients\ManageClients;
use App\Http\Livewire\Competitions\CompetitionDetail;
use App\Http\Livewire\Results\ManageResults;
use App\Http\Livewire\Users\InviteNewUsers;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.welcome');
})->name('welcome');
Route::get('/not-authorised', function () {
    return view('pages.NotAuthorised');
})->name('not-authorised');
Route::get('/profile', function () {
    return view('pages.profile');
})->name('profile');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/client/competition/{id}', CompetitionDetail::class)->name('client-competition');
    Route::get('/client/home/{id}', ClientHomePage::class)->name('client-home');
    Route::get('/client', ManageClients::class)->name('clients');
    Route::get('/client/invite', InviteNewUsers::class)->name('user.invite');
    Route::get('/competitions', ManageClients::class)->name('competitions');
    Route::get('/events', ManageClients::class)->name('events');

    Route::get('/results', ManageResults::class)->name('results');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

require __DIR__.'/auth.php';
