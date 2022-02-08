<?php

namespace App\Http\Controllers\Notify;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Notifications\DataCardsNotification;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public function index(Request $request)
    {
        $query = DataCardsNotification::query($request->user())->with('card.invoice.bank')
            ->select([
                'notifications.id',
                'notifications.notifiable_id',
                'notifications.data',
                'notifications.read_at',
                'notifications.created_at'
            ]);

        $result = $query->orderByDesc('notifications.created_at')->get()->map(function (Notification $notification) {
            $data = collect(json_decode($notification->data));
            $options = collect($data->get('options', []));

            return array_merge([
                'id' => $notification->id(),
                'read_at' => $notification->read_at,
                'image' => asset($notification->card->bank->icon),
                'created_at' => $notification->created_at->format('M d, Y H:i')
            ], $options->only('title', 'message')->toArray());
        });
        $query->clone()->whereNull('notifications.read_at')->update(['read_at' => now()]);

        return $result;
    }

    public function info(Request $request)
    {
        $cardsId = $request->user()->cards()->select('cards.id')->pluck('cards.id')->toArray();
        $query = DataCardsNotification::query($cardsId)
            ->select('notifications.id')->whereNull('notifications.read_at');

        return [
            'new_count' => $query->count()
        ];
    }
}
