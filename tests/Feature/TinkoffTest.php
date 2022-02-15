<?php

namespace Tests\Feature;

use App\Models\Bank\BankToken;
use App\Models\Bank\Card;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class TinkoffTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @return BankToken
     */
    public function bank(): BankToken
    {
        return BankToken::query()->where('url', 'https://business.tinkoff.ru')->first();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_f_test()
    {
        $response = $this->bank()->api()->getCardLimits(1147806003);
        dd($response, $response->json());
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_asfasda_test()
    {
        $oldCard = Card::query()->whereNotNull('correlation_id')->latest()->first();
        $correlationId = $oldCard->correlation_id;
        $api = $this->bank()->api();
        $response = $api->getStatusForReissuedCard($correlationId);

        $cardResponse = $response->collect();

        if ($cardResponse->get('status') == 'READY') {
            $cardInfo = collect($cardResponse->get('info'));
            $newUcid = $cardInfo->get('newUcid');
            $newCardInfo = $api->getCardInfo($newUcid)->collect();
            $expiryDate = collect($newCardInfo->get('expiryDate'));
            $month = $expiryDate->get('month');
            $year = $expiryDate->get('year');

            $newCard = new Card();
            $newCard->ucid = $newUcid;
            $newCard->number = $newCardInfo->get('number');
            $newCard->cvc = $newCardInfo->get('cvc');
            $newCard->expiredAt = Carbon::createFromFormat('m#Y#d H', "$month-$year-1 00");;
            $newCard->account_code = $oldCard->account_code;
            $newCard->bank_code = $oldCard->bank_code;
            $newCard->save();

            dd($newCard->refresh(), $newCard->numberFull, $newCard->cvc);

        }
    }
}
