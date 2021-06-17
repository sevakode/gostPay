<?php

use App\Http\Controllers\CardController;
use App\Interfaces\OptionsPermissions;
use Illuminate\Support\Facades\Route;

Route::get('card/{id}', [CardController::class, 'show'])->name('card')
    ->withoutMiddleware('auth.permission:'.OptionsPermissions::ACCESS_TO_ALL_CARDS_COMPANY['slug']);

Route::prefix('/cards')->group(function () {
    Route::get('/', [CardController::class, 'list'])->name('cards');

    Route::get('/create', [CardController::class, 'create'])
        ->middleware('auth.demo')
        ->middleware('auth.permission:' . OptionsPermissions::ACCESS_TO_CREATE_CARDS['slug'])
        ->name('cards.create');

    Route::post('/create/pdf', [CardController::class, 'sendPDF'])
        ->name('cards.create.pdf')
        ->middleware('auth.demo')
        ->middleware('auth.permission:' . OptionsPermissions::ACCESS_TO_CREATE_CARDS['slug']);

    Route::post('/create/xlsx', [CardController::class, 'sendXLSX'])
        ->name('cards.create.xlsx')
        ->middleware('auth.demo')
        ->middleware('auth.permission:' . OptionsPermissions::ACCESS_TO_CREATE_CARDS['slug']);

    Route::post('/create', [CardController::class, 'sendCard'])
        ->name('cards.create')
        ->middleware('auth.demo')
        ->middleware('auth.permission:' . OptionsPermissions::ACCESS_TO_CREATE_CARDS['slug']);

    Route::post('/limit', [CardController::class, 'setLimit'])
        ->name('cards.limit.update')
        ->middleware('isAjax')
        ->middleware('auth.demo')
        ->middleware('auth.permission:' . OptionsPermissions::ADMIN_ROLE_SET['slug']);

    Route::post('/download', [CardController::class, 'download'])
        ->name('cards.download.txt')
        ->middleware('auth.demo')
//                    ->middleware('auth.permission:'.OptionsPermissions::ACCESS_TO_MANAGER['slug'])
        ->withoutMiddleware('auth.permission:' . OptionsPermissions::ACCESS_TO_ALL_CARDS_COMPANY['slug']);
});
