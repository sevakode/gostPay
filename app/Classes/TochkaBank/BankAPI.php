<?php namespace App\Classes\TochkaBank;

use App\Classes\BankContract\BankConnectContract;
use App\Classes\BankMain;
use App\Classes\BankContract\BaseContracts;
use App\Classes\TochkaBank\Traits\ConnectBanking;
use App\Classes\TochkaBank\Traits\OpenBanking;
use App\Models\Bank\Card;
use App\Models\Bank\Payment;
use App\Models\Bank\Statement;
use Carbon\Carbon;
use Illuminate\Http\Client\Response;

class BankAPI extends BankMain implements BankConnectContract, BaseContracts
{
    use OpenBanking, ConnectBanking;

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

            $accountId = "$account->account_id/044525999";
            try {
                $balanceTypeList = $this->getBalanceInfo($accountId)->object()->Data->Balance;
            } catch (\Exception $e) {
                continue;
            }

            foreach ($balanceTypeList as $balance) {
                $data[$i]['currency'] = $balance->Amount->currency;

                if($balance->type == 'OpeningAvailable') {
                    $data[$i]['avail'] = $balance->Amount->amount;
                }
                else if ($balance->type == 'ClosingAvailable') {
                    $data[$i]['current'] = $balance->Amount->amount;
                }
            }

            $i++;
        }

        return $data;
    }

    public function getPaymentsData(array &$data): array
    {
        $data = array();
        $countCard = 0;
        foreach (Statement::all() as $statement) {
            $statement = $this->getStatement($statement->accountId, $statement->statementId)->object();
            foreach ($statement->Data->Statement[0]->Transaction as $payment)
            {
                preg_match("/карта (\d{4})\**(\d{4})/", $payment->description, $cards);
                preg_match("/дата операции:([^q]{10})/", $payment->description, $data);

                if(isset($cards[1], $cards[2])) {
                    if (!Payment::where('transaction_id', $payment->transactionId)->exists()) {
                        $cardId = Card::where('head', $cards[1])->where('tail', $cards[2])->first() ?
                            Card::where('head', $cards[1])->where('tail', $cards[2])->first()->id :
                            null;
                        if($cardId) $countCard++;

                        $data[] = [
                            'transaction_id' => $payment->transactionId,
                            'description' => $payment->description,
                            'account_id' => $statement->Data->Statement[0]->accountId,
                            'card_id' => $cardId,
                            'type' => $payment->creditDebitIndicator == 'Credit' ? Payment::REVENUE : Payment::EXPENDITURE,
                            'status' => $payment->status,
                            'amount' => $payment->Amount->amount,
                            'currency' => $payment->Amount->currency,
                            'operationAt' => Carbon::createFromFormat('d#m#Y H', $data[1] . ' 00'),
                        ];
                    }
                    else {
                        $cardId = Card::where('head', $cards[1])->where('tail', $cards[2])->first() ?
                            Card::where('head', $cards[1])->where('tail', $cards[2])->first()->id :
                            null;

                        $payment = Payment::where('transaction_id', $payment->transactionId)->first();
                        $payment->card_id = $cardId;
                        $payment->save();
                    }
                }
            }
        }
        $data['countCard'] = $countCard;

        return $data;
    }

    public function getStatementsData(array &$data): array
    {
        $accountList = $this->getAccountsList()->object();

        if(!isset($accountList->Data)) {
            $this->connectTokenRefresh()->object();
            return  $data;
        }
        foreach ($accountList->Data->Account as $account)
        {
            $statement = $this
                ->initStatement($account->accountId, '2020-08-01', now()->format('Y-m-d'))->json();

            $data[] = [
                'accountId' => $statement->Data->Statement->accountId,
                'statementId' => $statement->Data->Statement->statementId,
            ];
        }

        return $data;
    }

    public function getCardInfo(int $ucid): Response
    {
        // TODO: Implement getCardInfo() method.
    }

    public function getCardState(string $correlationId): Response
    {
        // TODO: Implement getCardState() method.
    }
}
