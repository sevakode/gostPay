<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification as Notify;

class DataNotification extends Notification
{
    use Queueable;

    private $notify;

    public const TEMPLATE_XL =
        '<div data-notify="container" class="alert alert-{0}" role="alert">' .
        '<button type="button" aria-hidden="true" class="close" data-notify="dismiss"></button>' .
        '<span data-notify="icon" style="bottom: 5px;"></span>' .
        '<span data-notify="title">{1}</span>' .
        '<span data-notify="message">{2}</span>' .
        '<div class="progress" data-notify="progressbar">' .
        '<div class="progress-bar progress-bar-animated bg-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' .
        '</div>' .
        '<a href="{3}" target="{4}" data-notify="url"></a>' .
        '</div>';

    /**
     * Create a new notification instance.
     * @param string $type
     * @param string $title
     * @param string $message
     * @param string $icon
     * @param int $timer
     * @param string $animate
     * @param string|null $template
     */
    public function __construct(
        string $type,
        string $title,
        string $message,
        string $icon,
        int $timer = 50000,
        string $animate = 'bounce',
        string $template = null)
    {
        $this->notify = array(
            'options' => [
                'icon' => $icon,
                'title' => $title,
                'message' => $message,
            ],
            'settings' => [
                'type' => $type,
                'timer' => $timer,
                'animate' => [
                    'enter' => $animate,
                    'exit' => $animate,
                ],
            ]
        );
        if(isset($template))
            $this->notify['template'] =  $template;

    }

    public static function success(): DataNotification
    {
        return new DataNotification(
            'dark', '',
            'Данные обновлены!', 'icon icon-xl flaticon2-check-mark text-success',
            50000, '', self::TEMPLATE_XL
        );
    }

    public static function sendErrors(array $messages, User $user = null, $title = '') {
        $user = is_null($user) ? Auth::user() : $user;
        foreach($messages as $message)
        {
            $data = new DataNotification(
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
