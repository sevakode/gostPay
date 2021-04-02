<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bank\Card;
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
        dd($request->operations);
        if($token !== self::TOKEN)
            return new JsonResponse(['error' => 'Неверный токен'], 405);

        if($bank == self::TOCHKABANK) {
            foreach ($request->operations as $operation) {
                preg_match_all('/В процессе\Wn(FACEBK .{3,20}) .*?[^W]([0-9]{4}|^0-9{4})/', $operation, $operationAr);

                $operationAr = $operationAr[0] ? array_column($operationAr, 0) : $operationAr;

                $cards = Card::where('tail', $operationAr[2]);
//                    ->whereHas('user', function (Builder $query) {
//                        $query->whereNotNull('telegram_chat');
//                    });

                if($cards->exists()) $cards->each(function (Card $card) use ($operationAr) {
                    TelegramNotification::sendOperations($card, $card->user, [$operationAr[1]]);
                });
            }
        }

        return new JsonResponse(true, 200);
    }
}
