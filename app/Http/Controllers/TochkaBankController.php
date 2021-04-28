<?php

namespace App\Http\Controllers;

use App\Classes\TochkaBank\BankAPI;
use App\Models\Bank\BankToken;
use App\Models\Company;
use App\Notifications\DataNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class TochkaBankController extends Controller
{
    public function register()
    {
        $token = BankToken::all()->first();
        $bank = new BankAPI($token);

        $bank->getAccountsList();
    }

    public function tokenAuth($company_key)
    {
//        $token = BankToken::all()->first();
//
//        $token->authCode = $_GET['code'];
//        $token->authCodeDate = now();
//        $_GET['state'];
//        if(request()->user()->company->bank->whereKey($company_key)->exists())
//            Notification::send(Auth::user(), DataNotification::success());
//
//        return redirect()->back();
    }
}
