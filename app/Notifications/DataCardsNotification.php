<?php

namespace App\Notifications;

use App\Models\Bank\Card;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Notification as Notify;

class DataCardsNotification extends Notification
{
    use Queueable;

    const DEFAULT_ICON = 'icon icon-xl flaticon2-check-mark text-success';
    const DEFAULT_TIMER = 5000;
    const DEFAULT_TITLE = 'Новое сообщение по карте!!!';

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

    /**
     * @param mixed $cardOrUser
     * @return Builder
     */
    public static function query($cardOrUser): Builder
    {
        if ($cardOrUser instanceof Card) {
            $query =  $cardOrUser->notifications();
        }
        else if (is_array($cardOrUser)) {
            $query =  \App\Models\Notification::query()->whereIn('notifiable_id', $cardOrUser);
        }
        else if ($cardOrUser instanceof User) {
            $query =  \App\Models\Notification::query()->whereHas('card', function ($query) use ($cardOrUser) {
                $query->where('cards.user_id', $cardOrUser->id);
            });
        }
        else {
            $query =  \App\Models\Notification::query()->whereHas('card', function ($query) use ($cardOrUser) {
                $query->where('cards.user_id', $cardOrUser);
            });
        }

        return $query->where('type', self::class);
    }

    public static function createMessage(string $message, Card $card, $title = null)
    {
        $data = new self(
            'dark', $title ?: self::DEFAULT_TITLE,
            $message, self::DEFAULT_ICON,
            self::DEFAULT_TIMER, '', self::TEMPLATE_XL
        );

        Notify::send($card, $data);
    }

    public static function createMessageList(array $messages, Card $card)
    {
        foreach($messages as $message)
        {
            self::createMessage($message, $card);
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
        return ['database'];
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
