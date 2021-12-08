<?php namespace App\Classes\Qiwi;


use App\Classes\BankMain;
use App\Classes\Qiwi\Traits\OpenBanking;

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
        return [];
    }

    public function getStatementsData(array &$data): array
    {
        return [];
    }

    public function refreshCards()
    {
        $count = 0;
        foreach ($this->getCards()->collect('cards') as $card) {
            if ($count > 100) continue;
            $cards[] = $this->getCardInfo($card['ucid'])->json();
            $count++;
        }
    }
//
//    public function getCardState(string $correlationId): Response
//    {
//
//    }
}
