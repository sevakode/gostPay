<?php

namespace App\Http\Controllers;

use App\Models\Bank\Card;
use App\Notifications\TelegramNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;

class NotificationController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index()
    {
        return view('product');
    }

    public function sendMessageNotification(Request $request): JsonResponse
    {
        $notify = $request->user()->unreadNotifications;
        $notify->markAsRead();

        return new JsonResponse($notify);
    }

    public static function sendMessageTelegramNotification(): JsonResponse
    {
        foreach (Card::select('id')->unreadNotifications()->get() as $notify) {
            (object) $data = json_decode($notify->data);

            $chatId = $data->user->telegram_chat;
            $code = $data->message;
            $tail = $data->card->tail;

            TelegramNotification::sendMessageFacebook($chatId, $code, $tail);

            Card::select('id')->unreadNotifications()->where('id', $notify->id)->update([
                'read_at' => now()
            ]);
        }

        return new JsonResponse(True);
    }

}
