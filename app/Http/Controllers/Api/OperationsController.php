<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bank\Card;
use App\Models\Bank\Account;
use App\Models\Bank\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class OperationsController extends Controller
{
    const TOKEN = '7YfynDjKtyVIKe3xczm0r8UOSDfutdDl';
    const TOCHKABANK = 'tochkabank';

    public function notifyOperations(Request $request, $bank, $token)
    {
        if ($token !== self::TOKEN) return new JsonResponse(['error' => 'Неверный токен!'], 405);
        if ($bank !== self::TOCHKABANK) return new JsonResponse(['error' => 'Неверный банк!'], 405);

        (array)$js = json_decode($request->input('json'), true);
        self::paymentsParse($js);
        self::invoicesParse($js);

        return new JsonResponse(true, 200);
    }

    private static function cardsParse(array $json)
    {
        if (isset($json) and
            isset($json['message_v1']) and
            isset($json['message_v1']['data']) and
            isset($json['message_v1']['data']['card_list']) and
            isset($json['message_v1']['data']['card_list']['cards']))
            (object) $card_list = $json['message_v1']['data']['card_list']['cards'];
        else return false;

        $cards = Card::getCollectParse($card_list);

        Card::update(
            $cards->toArray(),
            [
                'number',
                'card_description',
                'head',
                'tail',
                'card_type',
                'expiredAt',
                'state',
                'card_type'
            ]
        );

        return true;
    }

    private static function paymentsParse(array $json)
    {
        if (isset($json) and
            isset($json['result']) and
            isset($json['result']['time_line_list']))
            (object) $payment_list = $json['result']['time_line_list'];
        else return false;

        $payments = [];
        foreach ($payment_list as $payment) {
            $payment = $payment['data'];

            if (isset($payment['cardPan'])) {
                preg_match("/(\d{4})\**(\d{4})/", $payment['cardPan'], $cards);
                $cardId = Card::where('head', $cards[1])->where('tail', $cards[2])->first() ?
                    Card::where('head', $cards[1])->where('tail', $cards[2])->first()->id :
                    null;
            } else $cardId = null;

            if (isset($payment['stateInfo'])) {
                switch ($payment['stateInfo']) {
                    case 'A' :
                    case 'P' :
                        $status = Payment::PENDING;
                        break;
                    case 'C' :
                    case 'T' :
                    case 'E' :
                        $status = Payment::CANCELED;
                        break;
                    case 'S':
                        $status = Payment::BOOKED;
                        break;
                    default:
                        return [$payment['stateInfo'], $payment];
                }
            } else {
                $status = Payment::BOOKED;
            }

            if (isset($payment['cardOperationType']))
                $type = $payment['cardOperationType'] == 'purchase' ?
                    Payment::EXPENDITURE :
                    Payment::REVENUE;
            else $type = $payment['type'] == 'PaymentIncome' ?
                    Payment::REVENUE :
                    Payment::EXPENDITURE;

            try {
                $payments[] = [
                    'transaction_id' => $payment['cardTrnInfo']['trnId'] ?? $payment['corebankingId'],
                    'description' => $payment['title'] . ' ' . $payment['purpose'],
                    'account_id' => $payment['payerAccountId'],
                    'card_id' => $cardId,
                    'type' => $type,
                    'status' => $status,
                    'amount' => (float)$payment['sum'],
                    'currency' => $payment['sumCurrency'],
                    'operationAt' => Carbon::createFromFormat('Y-m-d H', $payment['shortItemDate'] . ' 00'),
                ];
            } catch (\Exception $e) {

            }
        }

        Payment::upsert(
            $payments,
            [
                'transaction_id',
                'description',
                'account_id',
                'card_id',
                'status',
                'amount',
                'currency',
                'operationAt',
            ]
        );
        return true;
    }

    private static function invoicesParse(array $json)
    {
        if (isset($json) and
            isset($json['message_v1']) and
            isset($json['message_v1']['data']) and
            isset($json['message_v1']['data']['multi_account_list_detailed']))
            $account_list = $json['message_v1']['data']['multi_account_list_detailed'];
        else return false;

        foreach ($account_list as $multi_account_list_detailed) {
            foreach ($multi_account_list_detailed as $account) {
                $main = $account['main'];
                $invoice = Account::where('account_id', $account['account_id'])->first();
                if($invoice) {
                    $invoice->avail = $main['avail'];
                    $invoice->current = $main['current'];
                    $invoice->save();
                }
            }
        }
    }
}

