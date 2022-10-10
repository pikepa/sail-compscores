<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Results\ManageResults;
use App\Http\Livewire\Organisation\ManageOrganisations;

Route::get('/', function () {
    return view('pages.welcome');
})->name('welcome');

Route::get('/profile', function () {
    return view('pages.profile');
})->name('profile');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/organisation', ManageOrganisations::class)->name('organisation');
Route::get('/results', ManageResults::class)->name('results');




require __DIR__.'/auth.php';
