<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bank\Card;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TelegramController extends Controller
{
    const TOKEN = '1642701852:AAFGin0id2ulxImyv05QLtkLThbymmCZZJ4';

    public function init($token)
    {
        if($token !== self::TOKEN)
            return new JsonResponse(['error' => 'Неверный токен'], 405);

        dd('гуд');
    }
}
