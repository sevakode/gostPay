<?php


use App\Http\Controllers\Notify\CardController;
use Illuminate\Support\Facades\Route;

Route::get('/cards', [CardController::class, 'index'])->name('notify.cards.user.index');
Route::get('/info', [CardController::class, 'info'])->name('notify.cards.user.info');
