<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bank\Card;
use App\Models\Company;
use App\Models\User;
use App\Notifications\TelegramNotification;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use function MongoDB\BSON\toJSON;

class TelegramController extends Controller
{

    public function init(Request $request, $token): JsonResponse
    {
        if($token !== env('TELEGRAM_TOKEN')) return new JsonResponse(['error' => 'Неверный токен'], 405);

        $chatId = $request->get('message')['chat']['id'];
        $username = $request->get('message')['chat']['username'];
        $message = $request->get('message')['text'];

        Log::info(trim($message));

        $user = User::whereTelegram($username)->first();

        switch ($message) {
            case '/start':
                if($user) {
                    if($user->telegram_chat != $chatId) {
                        $user->telegram_chat = $chatId;
                        $user->save();
                        TelegramNotification::sendMessage($chatId, 'Авторизация прошла успешно, ' . $user->fullName . '!');
                    }
                }
                else TelegramNotification::sendMessage($chatId,
                    "Ваш телеграмм не указан в системе!\n" .
                    "Добавьте свой username $username телеграма настройках профиля и попробуйте еще раз введя команду /auth"
                );
                break;

            case '/auth':
                if($user) {
                    if($user->telegram_chat == $chatId) {
                        TelegramNotification::sendMessage($chatId, 'Вы уже авторизованы');
                    } else {
                        $user->telegram_chat = $chatId;
                        $user->save();
                        TelegramNotification::sendMessage($chatId, 'Авторизация прошла успешно, ' . $user->fullName . '!');
                    }
                }
                else TelegramNotification::sendMessage($chatId,
                    "Ваш телеграмм не указан в системе!\n" .
                    "Добавьте свой username $username телеграма в настройках профиля и попробуйте еще раз"
                );
                break;
        }

    }
}
