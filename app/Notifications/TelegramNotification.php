<?php

namespace App\Notifications;

use App\Models\Bank\Card;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification as Notify;
use phpDocumentor\Reflection\Types\Integer;

class TelegramNotification extends Notification
{
    use Queueable;

    private $notify;

    /**
     * Create a new notification instance.
     * @param array $users
     * @param string $message
     * @param integer $tail
     */
    public function __construct(array $users, string $message, Integer $tail)
    {
        $this->notify = array(
            'users' => $users,
            'tail' => $tail,
            'message' => $message,
        );
    }

    public static function sendOperations(Card $card, $users, $message)
    {

    }

    public static function success(): TelegramNotification
    {
        return new TelegramNotification(
            'dark', '',
            'Данные обновлены!', 'icon icon-xl flaticon2-check-mark text-success',
            50000, '', self::TEMPLATE_XL
        );
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
