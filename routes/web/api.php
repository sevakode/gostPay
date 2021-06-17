<?php

use App\Http\Controllers\TochkaBankController;
use Illuminate\Support\Facades\Route;

Route::get('tauth/{key}', [TochkaBankController::class, 'tokenAuth'])->name('api.tauth');
//        Route::get('register', [TochkaBankController::class, 'register']);
