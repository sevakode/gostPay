<?php

use App\Http\Controllers\ChartsController;
use Illuminate\Support\Facades\Route;

Route::post('areas', [ChartsController::class, 'area'])
    ->name('charts.areas');
