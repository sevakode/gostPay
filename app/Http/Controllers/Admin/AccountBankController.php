<?php

namespace App\Http\Controllers\Admin;

use App\Classes\TochkaBank\BankAPI;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\Controller;
use App\Interfaces\OptionsPermissions;
use App\Models\Bank\BankToken;
use App\Models\Bank\Account;
use App\Models\Company;
use App\Models\User;
use App\Notifications\DataNotification;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification as Notify;

class AccountBankController extends Controller
{

    /** AJAX */
    public function sendList(Request $request)
    {
        $invoices = BankToken::all();

        $data = array();
        $option = array();

        foreach (config('bank_list.info') as $bank) {
            $option['text'] = $bank['title'];
            $option['children'] = [];
            foreach ($invoices->where('url', $bank['url']) as $invoice) {
                $option['children'][] = [
                    'id' => $invoice->id,
                    'text' => $invoice->title,
                    'selected' => true
                ];
            }
            $data['results'][] = $option;
        }

        return $request->wantsJson()
            ? new JsonResponse($data, 201)
            : redirect()->back();
    }

    public function sendCompanyList(Request $request)
    {
        $invoices = $request->user()->company->banks();

        $data = array();
        $option = array();

        foreach (config('bank_list.info') as $bank) {
            $option['text'] = $bank['title'];
            $option['children'] = [];

            foreach ($invoices->where('url', $bank['url'])->get() as $invoice) {
                $option['children'][] = [
                    'id' => $invoice->id,
                    'text' => $invoice->title,
                    'selected' => true
                ];
            }
            $data['items'][] = $option;
        }

        return $request->wantsJson()
            ? new JsonResponse($data, 201)
            : redirect()->back();
    }

    /** CRUD */
    public function list()
    {
        $page_title = 'Аккаунты';
        $page_description = $page_title;

        $accounts = BankToken::select('id', 'url', 'refreshTokenDate');

        return view('pages.account_bank.widgets.list',
            compact('page_title', 'page_description', 'accounts'));
    }

    public function create()
    {
        $page_title = 'Создание аккаунта';
        $page_description = $page_title;

        return view('pages.account_bank.widgets.create',
            compact('page_title', 'page_description'));
    }


    public function edit($id)
    {
        $page_title = 'Изменения аккаунта';
        $page_description = $page_title;

        $account = BankToken::find($id);

        return view('pages.account_bank.widgets.edit',
            compact('page_title', 'page_description', 'account'));
    }

    public function updating(Request $request, $id)
    {
        $company = $request->user()->company;
        $parametersBank = CompanyController::getParametersBank($request->typeBank);

        $bank = BankToken::find($id);
        $bank->update(array_merge(
            $request->only(['title', 'bankId', 'bankSecret', 'accessToken', 'refreshToken']),
            $parametersBank
        ));

        Notify::send($request->user(), DataNotification::success());

        return redirect()->back();
    }

    public function creating(Request $request)
    {
        $company = $request->user()->company;
        $parametersBank = CompanyController::getParametersBank($request->typeBank);
        $bank = BankToken::create(array_merge(
            $request->only(['title', 'bankId', 'bankSecret', 'accessToken', 'refreshToken']),
            array_merge($parametersBank))
        );

        Notify::send($request->user(), DataNotification::success());

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect(route('bank.account.list'));
    }

    public function delete(Request $request)
    {
        $account = BankToken::find($request->id);
        try {
            $account->companies()->detach($account->companies()->get()->pluck('id'));
            $account->delete();
            Notify::send($request->user(), DataNotification::success());
        }
        catch (\Exception $e) {
            dd('adas');
        }
        return $request->wantsJson()
            ? new JsonResponse(['account_id' => $request->id], 201)
            : redirect()->back();
    }
}
