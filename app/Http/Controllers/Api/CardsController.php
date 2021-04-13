<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bank\Card;
use App\Models\Company;
use Illuminate\Http\JsonResponse;

class CardsController extends Controller
{
    const TOKEN = '7YfynDjKtyVIKe3xczm0r8UOSDfutdDl';

    public function init()
    {
        dd('ad');
    }

    public function companyCardsTail($slug, $token, $status)
    {
        if($token !== self::TOKEN)
            return new JsonResponse(['error' => 'Неверный токен'], 405);

        $company = Company::whereSlug($slug)->first();
        $cards = $company->cards()->select('tail');

        if ($status == Card::ACTIVE) $cards = $cards->whereActive();
        else if ($status == Card::CLOSE) $cards = $cards->whereClose();

        $cardsAr = $cards->get()->toArray();

        return new JsonResponse($cardsAr, 200);
    }
}
