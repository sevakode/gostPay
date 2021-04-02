<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bank\Card;
use App\Models\Company;
use App\Models\User;
use App\Notifications\TelegramNotification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class OperationsController extends Controller
{
    const TOKEN = '7YfynDjKtyVIKe3xczm0r8UOSDfutdDl';
    const TOCHKABANK = 'tochkabank';

    public function notifyOperations(Request $request, $bank, $token)
    {
        $operations = [
            'егодня, 2 апреля\n-1\n \n937,\n50\n ₽\nОтменён\nFACEBK *XSDMLYN322 \nПокупка по карте *4119 на 25.00 USD',
            '-700\n ₽\nТочка ПАО Банка ФК Открытие\nОплата лицензионного вознаграждения за ПК Сервис Точка по тариф.пакету \'ачало\'за период с 01.04.21 по 30.04.21. Согласно Правилам дистанционного обслуживания. НДС не предусмотрен.',
            '-1\n \n162,\n50\n ₽\nОтменён\nFACEBK 6EWPXYJAA2 \nПокупка по карте *1008 на 15.00 USD',
            '-1\n \n162,\n50\n ₽\nОтменён\nFACEBK *V46HE23FG2 \nПокупка по карте *9426 на 15.00 USD',
            '-700\n ₽\nТочка ПАО Банка ФК Открытие\nОплата лицензионного вознаграждения за ПК Сервис Точка по тариф.пакету \'ачало\'за период с 01.04.21 по 30.04.21. Согласно Правилам дистанционного обслуживания. НДС не предусмотрен.',
            '-1\n \n162,\n50\n ₽\nВ процессе\nFACEBK SYFNV2K8S2 \nПокупка по карте *7048 на 15.00 USD',
            '-387,\n50\n ₽\nВ процессе\nFACEBK *LRC9SZEZ22 \nПокупка по карте *9148 на 5.00 USD',
            '-1\n \n162,\n50\n ₽\nВ процессе\nFACEBK Z7B9T2XUA2 \nПокупка по карте *9426 на 15.00 USD',
            '-86,\n80\n ₽\nВ процессе\nFACEBK *TRREB3B6F2 \nПокупка по карте *6257 на 1.12 USD',
            '-109,\n28\n ₽\nВ процессе\nFACEBK *8CZU33B7F2 \nПокупка по карте *6257 на 1.41 USD',
            '-18,\n60\n ₽\nВ процессе\nFACEBK *MXKFY4K6F2 \nПокупка по карте *6257 на 0.24 USD',
            '-775\n ₽\nВ процессе\nFACEBK *SNPNZYN9A2 \nПокупка по карте *9702 на 10.00 USD',
            '-775\n ₽\nВ процессе\nFACEBK *89YXH33RN2 \nПокупка по карте *7612 на 10.00 USD',
            '-1\n \n162,\n50\n ₽\nВ процессе\nFACEBK *EBXPTZNZ42 \nПокупка по карте *4952 на 15.00 USD',
            '-1\n \n162,\n50\n ₽\nВ процессе\nFACEBK PMMDF33XS2 \nПокупка по карте *9426 на 15.00 USD',
            '-775\n ₽\nВ процессе\nFACEBK CUGXT33WH2 \nПокупка по карте *4217 на 10.00 USD',
            '-775\n ₽\nВ процессе\nFACEBK VE4H92FEY2 \nПокупка по карте *7048 на 10.00 USD',
            '-1\n \n162,\n50\n ₽\nВ процессе\nFACEBK EKSY83KWB2 \nПокупка по карте *7832 на 15.00 USD',
            '-1\n \n162,\n50\n ₽\nВ процессе\nFACEBK *RD4JL3PPN2 \nПокупка по карте *1287 на 15.00 USD',
            '-1\n \n162,\n50\n ₽\nВ процессе\nFACEBK LNZZZ2P7C2 \nПокупка по карте *7832 на 15.00 USD',
            '-1\n \n162,\n50\n ₽\nВ процессе\nFACEBK *U3RB3ZWJ22 \nПокупка по карте *4618 на 15.00 USD',
            '-1\n \n162,\n50\n ₽\nВ процессе\nFACEBK *5VTD827N52 \nПокупка по карте *4281 на 15.00 USD',
            '-1\n \n162,\n50\n ₽\nВ процессе\nFACEBK *RWV2J233Z2 \nПокупка по карте *9148 на 15.00 USD',
            '-775\n ₽\nВ процессе\nFACEBK 4YRFL2T7X2 \nПокупка по карте *7602 на 10.00 USD',
            '-1\n \n937,\n50\n ₽\nВ процессе\nFACEBK FNDUUX6FN2 \nПокупка по карте *3605 на 25.00 USD',
            '-387,\n50\n ₽\nВ процессе\nFACEBK *GPC7J337F2 \nПокупка по карте *6257 на 5.00 USD',
            '-1\n \n162,\n50\n ₽\nВ процессе\nFACEBK *SG9M6538Q2 \nПокупка по карте *9702 на 15.00 USD',
            '-542,\n50\n ₽\nВ процессе\nFACEBK *A4D833X3N2 \nПокупка по карте *4952 на 7.00 USD',
            '-437,\n10\n ₽\nВ процессе\nFACEBK *HRABV2PHL2 \nПокупка по карте *7785 на 5.64 USD',
            '-25,\n58\n ₽\nВ процессе\nFACEBK *N2W4M37JL2 \nПокупка по карте *7785 на 0.33 USD',
            '-1\n \n162,\n50\n ₽\nВ процессе\nFACEBK *UQA354THH2 \nПокупка по карте *8239 на 15.00 USD',
            '-908,\n30\n ₽\nВ процессе\nFACEBK *G4P4927MF2 \nПокупка по карте *1287 на 11.72 USD',
            '-775\n ₽\nВ процессе\nFACEBK G3TLUYJU82 \nПокупка по карте *7832 на 10.00 USD',
            ' апреля\n-1\n \n162,\n50\n ₽\nВ процессе\nFACEBK VENPH3T2J2 \nПокупка по карте *1391 на 15.00 USD',
            '-1\n \n937,\n50\n ₽\nВ процессе\nFACEBK 5V9JZ2KRB2 \nПокупка по карте *5523 на 25.00 USD',
            '-775\n ₽\nВ процессе\nFACEBK *2PQGQZWAD2 \nПокупка по карте *2307 на 10.00 USD',
            '-374,\n33\n ₽\nВ процессе\nFACEBK *YR72WYJC92 \nПокупка по карте *1287 на 4.83 USD',
            '-775\n ₽\nВ процессе\nFACEBK PZH943PCV2 \nПокупка по карте *8069 на 10.00 USD',
            '-1\n \n937,\n50\n ₽\nВ процессе\nFACEBK 8CSB83TSW2 \nПокупка по карте *3605 на 25.00 USD',
            '-232,\n50\n ₽\nВ процессе\nFACEBK *BDLHSZ6232 \nПокупка по карте *9148 на 3.00 USD',
            '-542,\n50\n ₽\nВ процессе\nFACEBK N5FQS2XVY2 \nПокупка по карте *2813 на 7.00 USD',
            '-2\n \n712,\n50\n ₽\nВ процессе\nFACEBK *286JN2FDV2 \nПокупка по карте *4053 на 35.00 USD',
            '-1\n \n162,\n50\n ₽\nВ процессе\nFACEBK KV9SJ33YF2 \nПокупка по карте *5523 на 15.00 USD',
            '-1\n \n937,\n50\n ₽\nВ процессе\nFACEBK Z7TAF2FR32 \nПокупка по карте *4226 на 25.00 USD',
            '-1\n \n937,\n50\n ₽\nВ процессе\nFACEBK 3WA8E3B4S2 \nПокупка по карте *5523 на 25.00 USD',
            '-124\n ₽\nВ процессе\nFACEBK *FAXLQ3TDT2 \nПокупка по карте *3930 на 1.60 USD',
            '-775\n ₽\nВ процессе\nFACEBK *T2GUH33RN2 \nПокупка по карте *7612 на 10.00 USD',
            '-131,\n75\n ₽\nВ процессе\nFACEBK *AM3JZ2XDM2 \nПокупка по карте *4618 на 1.70 USD',
            '-1\n \n937,\n50\n ₽\nВ процессе\nFACEBK XJLBA3FJH2 \nПокупка по карте *4226 на 25.00 USD',
            '-775\n ₽\nВ процессе\nFACEBK MCY6P3KLQ2 \nПокупка по карте *3712 на 10.00 USD',
            '-232,\n50\n ₽\nВ процессе\nFACEBK *N9ZYQ2P6F2 \nПокупка по карте *6257 на 3.00 USD',
            '-775\n ₽\nВ процессе\nFACEBK *UD69HY29A2 \nПокупка по карте *9702 на 10.00 USD',
            '-1\n \n937,\n50\n ₽\nВ процессе\nFACEBK WY3PR2TTU2 \nПокупка по карте *9653 на 25.00 USD',
            '-775\n ₽\nВ процессе\nFACEBK *PAJHZ2XDM2 \nПокупка по карте *4618 на 10.00 USD',
            '-387,\n50\n ₽\nВ процессе\nFACEBK *YD69Z23JL2 \nПокупка по карте *7785 на 5.00 USD',
            '-1\n \n162,\n50\n ₽\nВ процессе\nFACEBK 8BV2P23AC2 \nПокупка по карте *9653 на 15.00 USD',
            '-232,\n50\n ₽\nВ процессе\nFACEBK *2AREHZ2232 \nПокупка по карте *9148 на 3.00 USD',
            '-542,\n50\n ₽\nВ процессе\nFACEBK N33SB23EY2 \nПокупка по карте *7048 на 7.00 USD',
            '-232,\n50\n ₽\nВ процессе\nFACEBK *5SYPG3BYF2 \nПокупка по карте *6485 на 3.00 USD',
            '-775\n ₽\nВ процессе\nFACEBK *U3P9F2TMD2 \nПокупка по карте *2975 на 10.00 USD',
            '-387,\n50\n ₽\nВ процессе\nFACEBK *JNNQ73F3N2 \nПокупка по карте *4952 на 5.00 USD',
            '-775\n ₽\nВ процессе\nFACEBK 8X7HR2TWH2 \nПокупка по карте *4217 на 10.00 USD',
            '-387,\n50\n ₽\nВ процессе\nFACEBK *QEWGFZWB92 \nПокупка по карте *1287 на 5.00 USD',
            '-232,\n50\n ₽\nВ процессе\nFACEBK *29A9B3B6F2 \nПокупка по карте *6257 на 3.00 USD',
            '-775\n ₽\nВ процессе\nFACEBK *FSY4847FG2 \nПокупка по карте *9426 на 10.00 USD',
            '-250\n ₽\nВ процессе\nFACEBK *PQY9C3KJQ2 \nПокупка по карте *8239',
            '-1\n \n162,\n50\n ₽\nВ процессе\nFACEBK DXR474FFR2 \nПокупка по карте *8069 на 15.00 USD',
            '-542,\n50\n ₽\nВ процессе\nFACEBK XLNST2T6X2 \nПокупка по карте *7602 на 7.00 USD',
            '-155\n ₽\nВ процессе\nFACEBK *FD56MZJZ22 \nПокупка по карте *9148 на 2.00 USD',
            '-775\n ₽\nВ процессе\nFACEBK *N6YRWZ6Z42 \nПокупка по карте *4952 на 10.00 USD',
            '-1\n \n162,\n50\n ₽\nВ процессе\nFacebk *ads \nПокупка по карте *0428 на 15.00 USD',
            '\n ₽\nОтменён\nFACEBK *YKY6C2XSD2 \nПокупка по карте *0264 на 3.48 USD',
            '\n ₽\nОтменён\nFACEBK *LGY6C2XSD2 \nПокупка по карте *0264 на 3.48 USD',
            '-775\n ₽\nВ процессе\nFACEBK *LG5DL3PPN2 \nПокупка по карте *1287 на 10.00 USD',
            '-542,\n50\n ₽\nВ процессе\nFACEBK 2FCDTYWT82 \nПокупка по карте *7832 на 7.00 USD',
            '-775\n ₽\nВ процессе\nFacebk *ads \nПокупка по карте *0428 на 10.00 USD',
            '-1\n \n162,\n50\n ₽\nВ процессе\nFACEBK PATU53P2J2 \nПокупка по карте *1391 на 15.00 USD',
            '-155\n ₽\nВ процессе\nFACEBK *86SESZ6232 \nПокупка по карте *9148 на 2.00 USD',
            '-232,\n50\n ₽\nВ процессе\nFACEBK *URD5G3FHL2 \nПокупка по карте *7785 на 3.00 USD',
            '-232,\n50\n ₽\nВ процессе\nFACEBK *T7HWP37XF2 \nПокупка по карте *6485 на 3.00 USD',
            '-155\n ₽\nВ процессе\nFACEBK *P2WQM4F6F2 \nПокупка по карте *6257 на 2.00 USD',
            '-1\n \n162,\n50\n ₽\nВ процессе\nFACEBK YYGB82FFC2 \nПокупка по карте *8232 на 15.00 USD',
            '-1\n \n162,\n50\n ₽\nВ процессе\nFACEBK 4KZMS37YF2 \nПокупка по карте *5523 на 15.00 USD',
            '-775\n ₽\nВ процессе\nFACEBK *PKJ9Q2F3Z2 \nПокупка по карте *9148 на 10.00 USD',
            '-1\n \n162,\n50\n ₽\nВ процессе\nFACEBK *SJU9ZYA422 \nПокупка по карте *4119 на 15.00 USD',
            '-232,\n50\n ₽\nВ процессе\nFACEBK *BDKNE3K3N2 \nПокупка по карте *4952 на 3.00 USD',
            '-1\n \n162,\n50\n ₽\nВ процессе\nFACEBK *VC5QG3BNF2 \nПокупка по карте *1287 на 15.00 USD',
            '-775\n ₽\nВ процессе\nFACEBK QASBWYA652 \nПокупка по карте *1008 на 10.00 USD',
            '-75\n \n000\n ₽\nОплачено 75000 ₽ Владислав Дмитриевич Ч.',
            '-155\n ₽\nВ процессе\nFACEBK *P9JKA2BED2 \nПокупка по карте *1229 на 2.00 USD',
            '-155\n ₽\nВ процессе\nFACEBK *G8BK5ZJ232 \nПокупка по карте *9148 на 2.00 USD',
            '-232,\n50\n ₽\nВ процессе\nFACEBK *UYTNFZWC92 \nПокупка по карте *1287 на 3.00 USD',
            '-775\n ₽\nВ процессе\nFACEBK *LNK953X7Q2 \nПокупка по карте *9702 на 10.00 USD',
            '-203,\n83\n ₽\nВ процессе\nFACEBK *LD4AQ237E2 \nПокупка по карте *4193 на 2.63 USD',
            '-26,\n35\n ₽\nВ процессе\nFACEBK *KGAZT3F7E2 \nПокупка по карте *2861 на 0.34 USD',
            '-775\n ₽\nВ процессе\nFACEBK 3D7VM23YJ2 \nПокупка по карте *1008 на 10.00 USD',
            '-775\n ₽\nВ процессе\nFACEBK *HSZ2K3TAD2 \nПокупка по карте *2307 на 10.00 USD',
            '00\n \n000\n ₽\nГУСЛИ-МЕДИА, ООО\nЗа разработку сайта. НДС не облагается',
            '-155\n ₽\nВ процессе\nFACEBK *BQGVQ2P6F2 \nПокупка по карте *6257 на 2.00 USD',
            '-775\n ₽\nВ процессе\nFACEBK V28MW27CV2 \nПокупка по карте *8069 на 10.00 USD',
            '-153,\n30\n ₽\n+0.77 баллов\nFACEBK 9P7QA2KWY2 \nПокупка по карте *2813 на 2.00 USD',
            '-153,\n30\n ₽\n+0.77 баллов\nFacebk *ads \nПокупка по карте *0428 на 2.00 USD',
            '1 марта\n-766,\n50\n ₽\n+3.83 балла\nFACEBK UBGBF3FFY2 \nПокупка по карте *3605 на 10.00 USD',
            '-153,\n30\n ₽\n+0.77 баллов\nFACEBK MPL87ZES72 \nПокупка по карте *7660 на 2.00 USD',
            '-153,\n30\n ₽\n+0.77 баллов\nFACEBK PRX863XTU2 \nПокупка по карте *6993 на 2.00 USD'
        ];
        if($token !== self::TOKEN)
            return new JsonResponse(['error' => 'Неверный токен'], 405);

        if($bank == self::TOCHKABANK) {
            foreach ($operations as $operation) {
                preg_match_all('/В процессе\Wn(FACEBK .{3,20}) .*?[^W]([0-9]{4}|^0-9{4})/', $operation, $operationAr);

                $operationAr = $operationAr[0] ? array_column($operationAr, 0) : $operationAr;

                $cards = Card::where('tail', $operationAr[2])
                    ->whereHas('user', function (Builder $query) {
                        $query->whereNotNull('telegram_chat');
                    });

                if($cards->exists()) $cards->each(function (Card $card) {
                    TelegramNotification::sendOperations($card, $card->user, ['adsf']);
                });
//                if($operationAr[0] != []) dd($operationAr[0], !is_null($operationAr[0]));
//                dd(isset($operationAr[0]), $operationAr);
//                $cards = Card::where('tail', $operationAr[1]);
//                $cards =Card::where('tail', 4567)->where('telegram_id', '!=', null)->select('user_id');
//                $userIds =array_column($cards->get()->toArray(), 'user_id');
//                $users = User::whereIn('id', $userIds);

            }
        }


//        return new JsonResponse('ok', 200);
    }
}
