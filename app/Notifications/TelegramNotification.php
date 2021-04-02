<?php

namespace App\Notifications;

use App\Models\Bank\Card;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification as Notify;

class TelegramNotification extends Notification
{
    use Queueable;

    private $notify;

    /**
     * Create a new notification instance.
     * @param int $card
     * @param int $user
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
        $ch = curl_init($website . '/sendMessage');
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, ($params));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close($ch);
    }

    public static function sendErrors(array $messages, User $user = null, $title = '') {
        $user = is_null($user) ? Auth::user() : $user;
        foreach($messages as $message)
        {
            $data = new TelegramNotification(
                'dark', $title, $message, 'icon flaticon-exclamation text-danger icon-xl', 5000,
                '', self::TEMPLATE_XL
            );
            Notify::send($user, $data);
        }
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
