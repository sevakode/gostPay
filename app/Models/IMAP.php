<?php

namespace App\Models;

use App\Models\Bank\Card;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webklex\IMAP\Facades\Client;

/** @property  \Webklex\PHPIMAP\Client $client */
class IMAP extends Model
{
    use HasFactory;

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
                $cards = Card::select('tail', 'id')->where('tail', $tail);

                if(isset($htmlBody)) {
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
        self::upsert(
            $this->getCollectMessage()->toArray(),
            [
                'uid',
                'message',
                'card_id',
            ]
        );
    }
}
