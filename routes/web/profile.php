<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProfileController::class, 'showPersonalInformation'])->name('profile_show');

Route::get('/cards', [ProfileController::class, 'showCards'])->name('profile_cards');

Route::post('/update', [ProfileController::class, 'updatePersonalInformation'])
    ->name('profile_update')
    ->withoutMiddleware('auth.demo');

Route::post('/create', [ProfileController::class, 'createUser'])
    ->name('profile_create')
    ->withoutMiddleware('auth.demo');
