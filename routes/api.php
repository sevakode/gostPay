<?php

use App\Http\Controllers\Api\CardsController;
use App\Http\Controllers\Api\OperationsController;
use App\Http\Controllers\Api\TelegramController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware( 'throttle:60,10')->group(function () {
    Route::get('/cards/{slug}/{token}', [CardsController::class, 'companyCards']);

    Route::get('/operations/{bank}/{token}', [OperationsController::class, 'notifyOperations']);
    Route::post('/telegram/{token}', [TelegramController::class, 'init']);
});
