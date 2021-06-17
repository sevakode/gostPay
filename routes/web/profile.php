<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProfileController::class, 'showPersonalInformation'])->name('profile_show');

Route::get('/cards', [ProfileController::class, 'showCards'])->name('profile_cards');

Route::post('/update', [ProfileController::class, 'updatePersonalInformation'])
    ->middleware('auth.demo')
    ->name('profile_update')
    ->middleware('auth.demo');

Route::post('/create', [ProfileController::class, 'createUser'])
    ->middleware('auth.demo')
    ->name('profile_create')
    ->middleware('auth.demo');
