<?php

use App\Http\Controllers\Admin\AccountBankController;
use App\Http\Controllers\ProfileController;
use App\Interfaces\OptionsPermissions;
use Illuminate\Support\Facades\Route;

Route::prefix('/accounts')
    ->middleware('auth.permission:'.OptionsPermissions::OWNER['slug'])
    ->group(function () {
        Route::get('/', [AccountBankController::class, 'list'])
            ->name('bank.account.list');
        Route::get('/create', [AccountBankController::class, 'create'])
            ->name('bank.account.create');
        Route::get('/{id}/edit', [AccountBankController::class, 'edit'])
            ->name('bank.account.edit');
        Route::post('/{id}/update', [AccountBankController::class, 'updating'])
            ->middleware('auth.demo')
            ->name('bank.account.updating');
        Route::post('/create', [AccountBankController::class, 'creating'])
            ->middleware('auth.demo')
            ->name('bank.account.creating');
        Route::delete('/delete', [AccountBankController::class, 'delete'])
            ->middleware('auth.demo')
            ->name('bank.account.delete');
    });

Route::post('/ajax', [AccountBankController::class, 'sendList'])
    ->name('bank.account.list.ajax')
//                ->middleware('auth.permission:'.OptionsPermissions::OWNER['slug'])
    ->middleware('isAjax');

Route::get('/', [ProfileController::class, 'showPersonalInformation'])
    ->name('profile_show');

Route::post('/update', [ProfileController::class, 'updatePersonalInformation'])
    ->name('profile_update')
    ->middleware('auth.demo');

Route::post('/create', [ProfileController::class, 'createUser'])
    ->name('profile_create')
    ->middleware('auth.demo');
