<?php namespace App\Classes\Qiwi;


use App\Classes\BankMain;
use App\Classes\Qiwi\Traits\OpenBanking;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;

class BankAPI extends BankMain
{
    use OpenBanking;

    public function getAccountsData(&$data)
    {

    }

    public function getPaymentsData(array &$data): array
    {
        return [];
    }

    public function getStatementsData(array &$data): array
    {
        return [];
    }

//    public function getCardInfo(int $ucid): Response
//    {
//        return new Response('asfda');
//    }
//
//    public function getCardState(string $correlationId): Response
//    {
//
//    }
}
