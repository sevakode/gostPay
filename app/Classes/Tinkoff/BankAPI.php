<?php namespace App\Classes\Tinkoff;


use App\Classes\BankMain;
use App\Classes\Tinkoff\Traits\ConnectBanking;
use App\Classes\Tinkoff\Traits\OpenBanking;
use App\Models\Bank\Account;

class BankAPI extends BankMain
{
    use OpenBanking, ConnectBanking;

    public function getAccountsData(&$data)
    {
        $i = 0;
        $accountsList = collect($this->getAccountsList());
        foreach (Account::get() as $account) {
            $accountApi = $accountsList->where('accountNumber', $account->account_id)->first();
            if ($accountApi) {
                $data[$i]['id'] = $account->id;
                $data[$i]['account_id'] = $account->account_id;
                $data[$i]['company_id'] = $account->company_id;
                $data[$i]['currency'] = $accountApi->currency == 643 ? 'RUB' : 'USD';
                $data[$i]['avail'] = $accountApi->balance->otb;
                $data[$i]['current'] = $accountApi->balance->authorized;
            }

            $i++;
        }

        return $data;
    }

    public function getStatementsData(array &$data): array
    {
        return $data;
    }

    public function getPaymentsData(array &$data): array
    {
        foreach (Account::all() as $account) {
            $statement = $this->initStatement($account->account_id, '2020-08-01', now()->format('Y-m-d'));
            dd($statement);

//            foreach ($statement->operation as $payment) {
//                $data[] = [
//                    'transaction_id' => $payment->operationId,
//                    'description' => $payment->description,
//                    'account_id' => $statement->Data->Statement[0]->accountId,
//                    'card_id' => $cardId,
//                    'type' => $payment->creditDebitIndicator == 'Credit' ? self::REVENUE : self::EXPENDITURE,
//                    'status' => $payment->status,
//                    'amount' => $payment->Amount->amount,
//                    'currency' => $payment->Amount->currency,
//                    'operationAt' => Carbon::createFromFormat('d#m#Y H', $data[1] . ' 00'),
//                ];
//            }

//            foreach ($statement->Data->Statement[0]->Transaction as $payment)
//            {
//                preg_match("/карта (\d{4})\**(\d{4})/", $payment->description, $cards);
//                preg_match("/дата операции:([^q]{10})/", $payment->description, $data);
//
//                if(isset($cards[1], $cards[2])) {
//                    if (!Payment::where('transaction_id', $payment->transactionId)->exists()) {
//                        $cardId = Card::where('head', $cards[1])->where('tail', $cards[2])->first() ?
//                            Card::where('head', $cards[1])->where('tail', $cards[2])->first()->id :
//                            null;
//
//                        $data[] = [
//                            'transaction_id' => $payment->transactionId,
//                            'description' => $payment->description,
//                            'account_id' => $statement->Data->Statement[0]->accountId,
//                            'card_id' => $cardId,
//                            'type' => $payment->creditDebitIndicator == 'Credit' ? self::REVENUE : self::EXPENDITURE,
//                            'status' => $payment->status,
//                            'amount' => $payment->Amount->amount,
//                            'currency' => $payment->Amount->currency,
//                            'operationAt' => Carbon::createFromFormat('d#m#Y H', $data[1] . ' 00'),
//                        ];
//                    }
//                    else {
//                        $cardId = Card::where('head', $cards[1])->where('tail', $cards[2])->first() ?
//                            Card::where('head', $cards[1])->where('tail', $cards[2])->first()->id :
//                            null;
//
//                        $payment = Payment::where('transaction_id', $payment->transactionId)->first();
//                        $payment->card_id = $cardId;
//                        $payment->save();
//                    }
//                }
//            }
        }

        return $data;
    }

}
