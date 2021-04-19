<?php

namespace App\Notifications;

use App\Models\Bank\Card;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Notification as Notify;

class TelegramNotification extends Notification
{
    use Queueable;

    private $notify;

    /**
     * Create a new notification instance.
     * @param Card $card
     * @param User $user
     * @param string $message
     */
    public function __construct(Card $card, User $user, string $message)
    {
        $this->notify = array(
            'user' => $user,
            'card' => $card,
            'message' => $message,
        );
    }

    public static function sendOperations(Card $card, User $user, $messages)
    {
        foreach($messages as $message)
        {
            $data = new TelegramNotification($card, $user, $message);
            Notify::send($card, $data);
        }
    }

    public static function sendMessage($chatId, $message)
    {
        $botToken = env('TELEGRAM_TOKEN');

        $website = "https://api.telegram.org/bot".$botToken;
        $params=[
            'chat_id' => $chatId,
            'text' => $message,
        ];

        return Http::post($website . '/sendMessage', $params)->json();
    }

    public static function sendMessageFacebook($chatId, $code, $tail)
    {
        if (! preg_match('/(FACEBK)/', $code)) return;

        $message = "На привязанную вам карту **** **** **** $tail пришло сообщение.\n Код: $code";

        return self::sendMessage($chatId, $message);
    }

    public static function sendMessageClosingCards($chatId, $cards)
    {
        $user = $cards->first()->user()->first();
        $message = "Поступили карты на закрытие: \n";
        foreach ($cards as $card) {
            $message .= "$card->number \n";
        }

        $message .= "от: $user->fullName\n";
        $message .= $user->telegram ? "@$user->telegram" : '';

        return self::sendMessage($chatId, $message);
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [ 'database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return $this->notify;
    }
}
