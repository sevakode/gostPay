<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bank\Card;
use App\Models\Bank\Account;
use App\Notifications\TelegramNotification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OperationsController extends Controller
{
    const TOKEN = '7YfynDjKtyVIKe3xczm0r8UOSDfutdDl';
    const TOCHKABANK = 'tochkabank';

    public function notifyOperations($bank, $token)
    {
//        Account::getCollectApi();
        $local = '{"json":"{\"message_v1\": {\"@time\": \"2021-04-14T20:28:07.550+05:00\", \"@type\": \"response\", \"data\": {\"@trn_code\": \"mirror_account_detailed_balance_query\", \"multi_account_list_detailed\": {\"accounts\": [{\"account_id\": \"40802810906500006235\", \"main\": {\"id\": 200423188805548, \"accountId\": \"40802810906500006235\", \"avail\": 75565.52, \"current\": 110072.04, \"plan\": 0.0, \"block\": 0.0, \"registry\": 0.0, \"avail_over_limit\": 0.0, \"cms_avail\": 75565.52, \"cms_avail_credit\": 0.0, \"cms_hold\": -34506.52, \"unprocessed\": 0.0, \"plan_with_unprocessed\": 0.0, \"over\": 0.0, \"tech_over\": 0.0, \"service_bank\": \"OPEN\"}}, {\"account_id\": \"40802810301500157556\", \"main\": {\"id\": 210329771705674, \"accountId\": \"40802810301500157556\", \"avail\": 3205.53, \"current\": 14021.44, \"plan\": 0.0, \"block\": 0.0, \"registry\": 0.0, \"avail_over_limit\": 0.0, \"cms_avail\": 3205.53, \"cms_avail_credit\": 0.0, \"cms_hold\": -10815.91, \"unprocessed\": 0.0, \"plan_with_unprocessed\": 0.0, \"over\": 0.0, \"tech_over\": 0.0, \"service_bank\": \"OPEN\"}}, {\"account_id\": \"40802978801500006492\", \"main\": {\"id\": 200622536766609, \"accountId\": \"40802978801500006492\", \"avail\": 0.0, \"current\": 0.0, \"plan\": 0.0, \"block\": 0.0, \"registry\": 0.0, \"avail_over_limit\": 0.0, \"cms_avail\": 0.0, \"cms_avail_credit\": 0.0, \"cms_hold\": 0.0, \"unprocessed\": 0.0, \"plan_with_unprocessed\": 0.0, \"over\": 0.0, \"tech_over\": 0.0, \"service_bank\": \"OPEN\"}}, {\"account_id\": \"40802840401500011627\", \"main\": {\"id\": 200709013512547, \"accountId\": \"40802840401500011627\", \"avail\": 0.0, \"current\": 0.0, \"plan\": 0.0, \"block\": 0.0, \"registry\": 0.0, \"avail_over_limit\": 0.0, \"cms_avail\": 0.0, \"cms_avail_credit\": 0.0, \"cms_hold\": 0.0, \"unprocessed\": 0.0, \"plan_with_unprocessed\": 0.0, \"over\": 0.0, \"tech_over\": 0.0, \"service_bank\": \"OPEN\"}}, {\"account_id\": \"40802978501500006491\", \"main\": {\"id\": 200622536766610, \"accountId\": \"40802978501500006491\", \"avail\": 0.0, \"current\": 0.0, \"plan\": 0.0, \"block\": 0.0, \"registry\": 0.0, \"avail_over_limit\": 0.0, \"cms_avail\": 0.0, \"cms_avail_credit\": 0.0, \"cms_hold\": 0.0, \"unprocessed\": 0.0, \"plan_with_unprocessed\": 0.0, \"over\": 0.0, \"tech_over\": 0.0, \"service_bank\": \"OPEN\"}}, {\"account_id\": \"40802840101500011626\", \"main\": {\"id\": 200709013512548, \"accountId\": \"40802840101500011626\", \"avail\": 4241.56, \"current\": 4837.89, \"plan\": 0.0, \"block\": 0.0, \"registry\": 0.0, \"avail_over_limit\": 0.0, \"cms_avail\": 4241.56, \"cms_avail_credit\": 0.0, \"cms_hold\": -596.33, \"unprocessed\": 0.0, \"plan_with_unprocessed\": 0.0, \"over\": 0.0, \"tech_over\": 0.0, \"service_bank\": \"OPEN\"}}]}}, \"state_info\": {\"@state\": \"processed\"}}}"}';

        if ($token !== self::TOKEN)
            return new JsonResponse(['error' => 'Неверный токен'], 405);

        if ($bank == self::TOCHKABANK) {
            //(array)$js = json_decode($request->input('json'), true)['message_v1'];
            (array)$js = json_decode($local, true);
            $js = json_decode($js['json'], true)['message_v1'];

            foreach ($js['data']['multi_account_list_detailed'] as $multi_account_list_detailed) {
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
            dd(Account::all());

//            foreach ($request->all() as $operation) {
//                preg_match_all('/В процессе\Wn(FACEBK .{3,20}) .*?[^W]([0-9]{4}|^0-9{4})/', $operation, $operationAr);
//                $operationAr = $operationAr[0] ? array_column($operationAr, 0) : $operationAr;
//                //Телеграм логер
//                Http::post('https://api.telegram.org/bot1642701852:AAFGin0id2ulxImyv05QLtkLThbymmCZZJ4/sendMessage',
//                    array(
//                        'chat_id' => '689839038',
//                        'text' => $operation
//                    )
//                );
//                //Телеграм логер
//                $isCopy = Card::select('id')
//                    ->unreadNotifications()
//                    ->where('data', 'LIKE', '%' . $operationAr[1] . '%')
//                    ->exists();
//                if ($isCopy) continue;
//
//                $cards = Card::where('tail', $operationAr[2]);
////                    ->whereHas('user', function (Builder $query) {
////                        $query->whereNotNull('telegram_chat');
////                    });
//
//                if ($cards->exists()) $cards->each(function (Card $card) use ($operationAr) {
//                    TelegramNotification::sendOperations($card, $card->user, [$operationAr[1]]);
//                });
//            }
        }

        return new JsonResponse(true, 200);
    }

    private function
}

