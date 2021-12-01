<?php namespace App\Classes\Qiwi;


use App\Classes\BankMain;
use App\Classes\Qiwi\Traits\OpenBanking;
use App\Models\Bank\Card;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Support\Str;

class BankAPI extends BankMain
{
    use OpenBanking;

    public function getAccountsData(&$data)
    {
        $i = 0;
        foreach ($this->bank->invoices()->get() as $account) {
            $data[$i] = [
                'id' => $account->id,
                'account_id' => $account->account_id,
                'bank_token_id' => $account->bank_token_id,
                'company_id' => $account->company_id,
            ];
            $accountResponse = $this->bank->api()->getBalanceInfo($account->account_id);
            $balanceInfo = (object) $accountResponse
                ->collect('accounts')
                ->where('hasBalance', true)
                ->first();

            $data[$i]['avail'] = $balanceInfo->balance['amount'];
            $data[$i]['current'] = $balanceInfo->balance['amount'];

            switch ($balanceInfo->balance['currency']) {
                case 643:
                    $data[$i]['currency'] = 'RUB';
            }

            $i++;
        }

        return $data;
    }

    public function getPaymentsData(array &$data): array
    {


//        $data[] = [
//            'transaction_id' => $payment->operationId,
//            'description' => $payment->paymentPurpose,
//            'account_id' => $account->account_id ?? $payment->payerAccount,
//            'card_id' => $cardId ?? '',
//            'type' => $type,
//            'status' => Payment::BOOKED,
//            'amount' => $payment->amount,
//            'currency' => $account->currency ?? 'RUB',
//            'operationAt' => \Illuminate\Support\Carbon::createFromFormat('Y-m-d H', $payment->date . ' 00'),
//        ];


        return $data;
    }

    public function getStatementsData(array &$data): array
    {
        return [];
    }

    public function refreshCards()
    {
        $cards = $this->getCards()->collect();

        $cards->each(function ($card) {
            $qvx = (object) $card['qvx'];
            $info = (object) $card['info'];
            $requisites = $this->getCardInfo($qvx->id)->object();

            $number = Card::getNumberSplit($requisites->pan);
            $queryCard = Card::query()->where('head', $number[0])->where('tail', $number[3]);

            $modelCard = $queryCard->get(['id', 'number'])->map(function (Card $card) use($requisites) {
                if ($card->numberFull == $requisites->pan)
                    return $card->refresh();
                return null;
            })->filter()->first();

            $modelCard->ucid = $qvx->id;
            $modelCard->expiredAt = Carbon::createFromFormat(DateTimeInterface::W3C ,$qvx->cardExpire);
            $modelCard->state = Str::lower($qvx->status) == 'active' ? Str::lower($qvx->status) : 'close';
            $modelCard->card_description = $info->name;
            $modelCard->card_type = $info->type;
            $modelCard->bank_code = $info->alias;

            $modelCard->save();
        });
    }
//
//    public function getCardState(string $correlationId): Response
//    {
//
//    }
}
