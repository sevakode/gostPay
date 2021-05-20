<?php

namespace App\Models;

use App\Models\Bank\Card;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webklex\IMAP\Facades\Client;
use Webklex\PHPIMAP\Message;

/** @property  \Webklex\PHPIMAP\Client $client */
class IMAP extends Model
{
    use HasFactory;

    protected $dates = ['updated_at'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->client = Client::account('default');
    }

    public function getCollectMessage()
    {
        $folders = $this->client->getFolders();

        $list = [];
        foreach ($folders as $folder) {
            $messages = $folder->messages()->all()->get();

            foreach ($messages as $message) {
                preg_match('/Текст сообщения: (.+)<\Wdiv>/', $message->getHTMLBody(), $htmlBody);
                $htmlBody = $htmlBody[1] ?? null;
                preg_match('/Карта \W(\d{4})/', $htmlBody, $tail);
                $tail = $tail[1] ?? null;
                $head = collect(config('bank_list.info'))->where('title', 'Tinkoff')->first()['bin'];
                $head = substr($head, 0, 3);
                $cards = Card::select('head', 'tail', 'id')->where('head', $head)->where('tail', $tail);
                if(isset($htmlBody) and !IMAP::where('uid', $message->get('uid'))->exists()) {
                    foreach ($cards->get() as $card) {
                        $list[] = [
                            'uid' => $message->get('uid'),
                            'message' => $htmlBody,
                            'card_id' => $card->id
                        ];
                    }
                }
            }
        }

        return collect($list);
    }

    public function refreshMessages()
    {
        $list = $this->getCollectMessage();
        self::upsert(
            $list->toArray(),
            [
                'uid',
                'message',
                'card_id',
            ]
        );

        return $list;
    }

    public function scopeNowDay($query)
    {
        return $query->where("updated_at", ">=", date("Y-m-d H:i:s", strtotime('-24 hours', time())));
    }
}
