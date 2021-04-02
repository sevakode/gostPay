<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bank\Card;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use function MongoDB\BSON\toJSON;

class TelegramController extends Controller
{
    const TOKEN = '1642701852:AAFGin0id2ulxImyv05QLtkLThbymmCZZJ4';

    public function init(Request $request, $token)
    {
        if($token !== self::TOKEN) return new JsonResponse(['error' => 'Неверный токен'], 405);

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
                        self::sendMessage($chatId, 'Авторизация прошла успешно, ' . $user->fullName . '!');
                    }
                }
                else self::sendMessage($chatId,
                    "Ваш телеграмм не указан в системе!\n" .
                    "Добавьте свой username $username телеграма настройках профиля и попробуйте еще раз введя команду /auth"
                );
                break;

            case '/auth':
                if($user) {
                    if($user->telegram_chat == $chatId) {
                        self::sendMessage($chatId, 'Вы уже авторизованы');
                    } else {
                        $user->telegram_chat = $chatId;
                        $user->save();
                        self::sendMessage($chatId, 'Авторизация прошла успешно, ' . $user->fullName . '!');
                    }
                }
                else self::sendMessage($chatId,
                    "Ваш телеграмм не указан в системе!\n" .
                    "Добавьте свой username $username телеграма в настройках профиля и попробуйте еще раз"
                );
                break;
        }

    }

    public static function sendMessage($chatId, $message)
    {
        $botToken = self::TOKEN;

        $website = "https://api.telegram.org/bot".$botToken;
        $params=[
            'chat_id' => $chatId,
            'text' => $message,
        ];
        $ch = curl_init($website . '/sendMessage');
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, ($params));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close($ch);
    }
}
