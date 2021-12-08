<?php

use App\Http\Controllers\Api\CardsController;
use App\Http\Controllers\Api\OperationsController;
use App\Http\Controllers\Api\TelegramController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
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

    Route::post('/sms',function (){
        $params=[
            'chat_id' => '-759153843',
            'text' => "ОТ:".request()->phone."\n".urldecode(request()->text),
        ];
        $token='1817784126:AAF5OUx9POsKG0zJ8DSRW7i0ca6h3_8MG14';
        $url='https://api.telegram.org/bot'.$token;

        return Http::post($url.'/sendMessage',$params);
    });

    Route::get('/cards/{slug}/{token}/{status}', [CardsController::class, 'companyCardsTail']);

    Route::post('/operations/{bank}/{token}', [OperationsController::class, 'notifyOperations']);
    Route::post('/telegram/{token}', [TelegramController::class, 'init']);
});
