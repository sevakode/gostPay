<?php

namespace Tests\Feature;

use App\Models\Bank\Card;
use App\Models\Notification;
use App\Models\User;
use App\Notifications\DataCardsNotification;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class NotifyTest extends TestCase
{
//    use DatabaseTransactions;


    public function user(): User
    {
        return User::query()->find(66);
    }


    public function test_create_success()
    {
        $text_list = [
            'Отмена регулярной покупки. Карта *3632. 2 USD. FACEBK ADS. Доступно',

            '351772 RUB',

            'Регулярная покупка. Карта *9560. 1000 MXN. FACEBK *WPLUMBTRL2. Дост',

            'упно 351616.8 RUB',

            'Регулярная покупка. Карта *2452. 10 USD. FACEBK *N43EGBB5W2. Доступ',

            'но 355349.8 RUB',

            'Регулярная покупка. Карта *2452. 75 USD. FACEBK GRJZRCB2Z2. Доступн',

            'о 365765.05 RUB',

        ];

        foreach ($text_list as $text) {
            $data = [
                'text' => $text
            ];
            $response = $this->post(route('sms'), $data);
//            dd($response->json());
        }
        dd(Notification::all()->map(function (Notification $notification) {
            return json_decode($notification->data)->options->message;
        }));
    }

    public function test_create_notify_for_card()
    {
        $user = $this->user()->cards()->pluck('cards.id')->toArray();
        DataCardsNotification::createMessage('!!!', $this->user()->cards()->first());

        dd(DataCardsNotification::query($user)->get());
    }

    public function test_sms_card()
    {
        $text_list = [
            'Отмена регулярной покупки. Карта *3632. 2 USD. FACEBK ADS. Доступно',
            '351772 RUB',
            'Регулярная покупка. Карта *9560. 1000 MXN. FACEBK *WPLUMBTRL2. Дост',
            'упно 351616.8 RUB',
            'Регулярная покупка. Карта *2452. 10 USD. FACEBK *N43EGBB5W2. Доступ',
            'но 355349.8 RUB',
            'Регулярная покупка. Карта *2452. 75 USD. FACEBK GRJZRCB2Z2. Доступн',
            'о 365765.05 RUB',
        ];
        $pattern = '/Карта\s[*](\d*)[.]\s(\d*[.]\d*|\d*)\s([a-zA-Z]*)/';

        foreach ($text_list as $text) {
            $message_options = session('message_options');
            if (!$message_options) {
                if (preg_match($pattern, $text, $output_array)) {
                    session(['message_options' => collect([
                        'message' => $text,
                        'tail' => $output_array[1],
                        'sum' => $output_array[2],
                        'currency' => $output_array[3]
                    ])]);
                }
            } else {
                $message_options = session('message_options');

                $cards = Card::query()->where('tail', $message_options->get('tail'))->get();
                $text = $message_options->get('message') . ' ' . $text;

                $cards->map(function (Card $card) use ($text, $message_options) {
                    DataCardsNotification::createMessage($text, $card, '*'.$message_options->get('tail'));
                });

                session(['message_options' => null]);
            }
        }
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_index_success()
    {
        Session::start();
        $this->be($this->user());

        $response = $this->get(route('notify.cards.user.index'), ['_token' => Session::token()]);
        dd($response->json());
        $response->assertStatus(200);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_info_success()
    {
        Session::start();
        $this->be($this->user());

        $response = $this->get(route('notify.cards.user.info'), ['_token' => Session::token()]);
        dd($response->json());
        $response->assertStatus(200);
    }
}
