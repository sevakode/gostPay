<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bank\Card;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class OperationsController extends Controller
{
    const TOKEN = '7YfynDjKtyVIKe3xczm0r8UOSDfutdDl';
    const TOCHKABANK = 'tochkabank';

    public function init()
    {
        dd('ad');
    }

    public function notifyOperations(Request $request, $bank, $token): JsonResponse
    {
        if($token !== self::TOKEN)
            return new JsonResponse(['error' => 'Неверный токен'], 405);

        if($bank == self::TOCHKABANK) {
            foreach ($request->operations as $operation) {
                preg_match('/(FACEBK .{3,20}).*?([^\W]{4}|^0-9{4})/', $operation, $operationAr);

                $cards = Card::where('tail', $operationAr[1]);
                $cards =Card::where('tail', 4567)->where('telegram_id', '!=', null)->select('user_id');
                $userIds =array_column($cards->get()->toArray(), 'user_id');
                $users = User::whereIn('id', $userIds);
            }
        }


        return new JsonResponse('ok', 200);
    }
}
