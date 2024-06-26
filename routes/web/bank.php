<?php

use App\Http\Controllers\CardController;
use App\Interfaces\OptionsPermissions;
use Illuminate\Support\Facades\Route;

Route::get('card/{id}', [CardController::class, 'show'])->name('card')
    ->withoutMiddleware('auth.permission:'.OptionsPermissions::ACCESS_TO_ALL_CARDS_COMPANY['slug']);

Route::prefix('/cards')->group(function () {
    Route::get('/', [CardController::class, 'list'])->name('cards')
        ->middleware('auth.permission:' . OptionsPermissions::ACCESS_TO_ALL_CARDS_COMPANY['slug']);

    Route::get('/create', [CardController::class, 'create'])
        ->withoutMiddleware('auth.demo')
        ->middleware('auth.permission:' . OptionsPermissions::ACCESS_TO_CREATE_CARDS['slug'])
        ->name('cards.create');

    Route::post('/create/pdf', [CardController::class, 'sendPDF'])
        ->name('cards.create.pdf')
        ->withoutMiddleware('auth.demo')
        ->middleware('auth.permission:' . OptionsPermissions::ACCESS_TO_CREATE_CARDS['slug']);

    Route::post('/create/xlsx', [CardController::class, 'sendXLSX'])
        ->name('cards.create.xlsx')
        ->withoutMiddleware('auth.demo')
        ->middleware('auth.permission:' . OptionsPermissions::ACCESS_TO_CREATE_CARDS['slug']);

    Route::post('/create', [CardController::class, 'sendCard'])
        ->name('cards.create')
        ->withoutMiddleware('auth.demo')
        ->middleware('auth.permission:' . OptionsPermissions::ACCESS_TO_CREATE_CARDS['slug']);

    Route::post('/generate', [CardController::class, 'generateCards'])
        ->name('cards.generate')
        ->withoutMiddleware('auth.demo')
        ->middleware('auth.permission:' . OptionsPermissions::ACCESS_TO_CREATE_CARDS['slug']);

    Route::post('/limit', [CardController::class, 'setLimit'])
        ->name('cards.limit.update')
        ->middleware('isAjax')
        ->withoutMiddleware('auth.demo');

    Route::post('/download', [CardController::class, 'download'])
        ->name('cards.download.txt')
        ->withoutMiddleware('auth.demo')
//                    ->middleware('auth.permission:'.OptionsPermissions::ACCESS_TO_MANAGER['slug'])
        ->withoutMiddleware('auth.permission:' . OptionsPermissions::ACCESS_TO_ALL_CARDS_COMPANY['slug']);
});
