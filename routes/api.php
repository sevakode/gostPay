<?php

use App\Http\Controllers\Api\CardsController;
use App\Http\Controllers\Api\OperationsController;
use App\Http\Controllers\Api\TelegramController;
use App\Models\Bank\Card;
use App\Notifications\DataCardsNotification;
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

    Route::post('/sms',function (Request $request){
//        $params=[
//            'chat_id' => '-759153843',
//            'text' => "ОТ:".request()->phone."\n".urldecode(request()->text),
//        ];
//        $token='1817784126:AAF5OUx9POsKG0zJ8DSRW7i0ca6h3_8MG14';
//        $url='https://api.telegram.org/bot'.$token;


        $pattern = '/Карта\s[*](\d*)[.]\s(\d*[.]\d*|\d*)\s([a-zA-Z]*)/';

//dd(session('message_options'));
        $message_options = session('message_options');
        $message_options = cache()->get('message_options');

        if (!$message_options) {
            if (preg_match($pattern, $request->get('text'), $output_array)) {
                cache()->add('message_options', collect([
                    'message' => $request->get('text'),
                    'tail' => $output_array[1],
                    'sum' => $output_array[2],
                    'currency' => $output_array[3]
                ]));
                session(['message_options' => collect([
                    'message' => $request->get('text'),
                    'tail' => $output_array[1],
                    'sum' => $output_array[2],
                    'currency' => $output_array[3]
                ])]);
            }
        } else {
            $message_options = session('message_options');
            $message_options = cache()->get('message_options');

            $cards = Card::query()
                ->where('tail', $message_options->get('tail'))
                ->has('company')
                ->get();
            $text = $message_options->get('message') . ' ' . $request->get('text');

            $cards->map(function (Card $card) use ($text, $message_options) {
                DataCardsNotification::createMessage($text, $card, '*'.$message_options->get('tail'));
            });

            session(['message_options' => null]);
            cache()->delete('message_options');
        }


//        return Http::post($url.'/sendMessage',$params);
        return [];
    })->name('sms');

    Route::get('/cards/{slug}/{token}/{status}', [CardsController::class, 'companyCardsTail']);

    Route::post('/operations/{bank}/{token}', [OperationsController::class, 'notifyOperations']);
    Route::post('/telegram/{token}', [TelegramController::class, 'init']);
});
