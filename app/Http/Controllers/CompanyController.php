<?php

namespace App\Http\Controllers;

use App\Classes\TochkaBank\BankAPI;
use App\Http\Controllers\Controller;
use App\Interfaces\OptionsPermissions;
use App\Models\Bank\BankToken;
use App\Models\Bank\Invoice;
use App\Models\Company;
use App\Models\User;
use App\Notifications\DataNotification;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification as Notify;

class CompanyController extends Controller
{
    public function list()
    {
        $page_title = 'Компании';
        $page_description = $page_title;

        return view('pages.company.widgets.list', compact('page_title', 'page_description'));
    }

    public static function auth(User $user, int $id)
    {
        $user->company_id = $id;
        $user->save();
    }

    public function login(Request $request)
    {
        self::auth($request->user(), $request->id);
        Notify::send($request->user(), DataNotification::success());

        return $request->wantsJson()
            ? new JsonResponse(true, 201)
            : redirect()->back();
    }

    public function destroy(Request $request)
    {
        $company = Company::find($request->id);
        $company->delete();
        Notify::send($request->user(), DataNotification::success());
        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect()->back();
    }

    public function loginAndShow($id)
    {
        self::auth(request()->user(), $id);
        return redirect(route('company.show'));
    }

    public function show($id='')
    {
        return redirect(route('dashboard'));
    }

    public function create()
    {
        $page_title = 'Открытие новой компании';
        $page_description = $page_title;

        return view('pages.company.widgets.create', compact('page_title', 'page_description'));
    }


    public function edit()
    {
        $page_title = 'Открытие новой компании';
        $page_description = $page_title;

        return view('pages.company.widgets.edit', compact('page_title', 'page_description'));
    }

    public function creating(Request $request)
    {
        $company = Company::create([
            'name' => $request->name,
        ]);
        $file = $request->file('company_avatar');
        if(isset($file))
            $company->image('avatar')->make($file, 'images/company/avatar/original/');

        $parametersBank = $this->getParametersBank($request->typeBank);
        $bank = BankToken::create(
            array_merge($request->only(['bankId', 'bankSecret', 'accessToken', 'refreshToken']), array_merge($parametersBank, ['company_id' => $company->id]))
        );

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect(route('company.list'));
    }

    public function update(Request $request)
    {
        $company = $request->user()->company;
        $company->name = $request->name;
        $accounts = array();
        foreach ($request->account_id as $account)
        {
            $account['company_id'] = $company->id;
            $accounts[] = $account;
        }
        $company->save();

        if($request->user()->hasPermission(OptionsPermissions::ACCESS_TO_ALL_COMPANY['slug'])) {
            Invoice::where('company_id', $company->id)
                ->whereNotIn('account_id', array_column($accounts, 'account_id'))
                ->delete();

            Invoice::upsert(
                $accounts,
                ['account_id', 'company_id'],
                ['account_id', 'company_id']
            );
        }

        $file = $request->file('company_avatar');
        if(isset($file))
            $company->image('avatar')->make($file, 'images/company/avatar/original/');

        $parametersBank = $this->getParametersBank($request->typeBank);
        $company->bank->update( array_merge(
            $request->only(['key', 'bankId', 'bankSecret', 'accessToken', 'refreshToken']),
            array_merge($parametersBank, ['company_id' => $company->id])
        ));

        Notify::send($request->user(), DataNotification::success());

        return redirect()->back();
    }

    public function logout()
    {
        $user = \request()->user();
        $user->logoutCompany();

        return redirect()->back();
    }

    private function getParametersBank($type)
    {
        if($type == 'tochkabank')
            return [
                'url' => 'https://enter.tochka.com',
                'rsUrl' => 'https://enter.tochka.com/uapi',
                'apiVersion' => 'v1.0',
            ];

        return null;
    }

    public function downloadReportUsersXls(Request $request)
    {
        $company = $request->user()->company;

        return $company->exportReportXls();
    }
}
