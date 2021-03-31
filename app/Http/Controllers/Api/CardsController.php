<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\JsonResponse;

class CardsController extends Controller
{
    const TOKEN = '7YfynDjKtyVIKe3xczm0r8UOSDfutdDl';

    public function init()
    {
        dd('ad');
    }

    public function companyCards($slug, $token)
    {
        if($token !== self::TOKEN)
            return new JsonResponse(['error' => 'Неверный токен'], 405);

        $company = Company::whereSlug($slug)->first();
        $cards = $company->cards()->select('tail')->get();
        $cardsAr = $cards->toArray();

        return new JsonResponse($cardsAr);
    }
}
