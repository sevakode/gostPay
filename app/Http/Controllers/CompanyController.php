<?php

namespace App\Http\Controllers;

use App\Classes\TochkaBank\BankAPI;
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

class CompanyController extends Controller
{

    /** CRUD */
    public function list()
    {
        $page_title = 'Компании';
        $page_description = $page_title;

        return view('pages.company.widgets.list', compact('page_title', 'page_description'));
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

        foreach ($request->bank_auth as $bank) {
            $company->banks()->attach($bank);
        }

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect(route('company.list'));
    }

    public function update(Request $request)
    {
        $company = $request->user()->company;
        $company->name = $request->name;
        $company->save();

        $file = $request->file('company_avatar');
        if(isset($file))
            $company->image('avatar')->make($file, 'images/company/avatar/original/');

        $accountList = $company->banks()->get()->pluck('id')->toArray();
        $detachList = array_diff($accountList, $request->bank_auth);
        $attachList = array_diff($request->bank_auth, $accountList);
        foreach ($detachList as $bank) {
            $company->banks()->detach($bank);
        }
        foreach ($attachList as $bank) {
            $company->banks()->attach($bank);
        }

        Notify::send($request->user(), DataNotification::success());

        return redirect()->back();
    }


    /** LOGIN */
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

    public function loginAndShow($id)
    {
        self::auth(request()->user(), $id);
        return redirect(route('company.show'));
    }

    public function logout()
    {
        $user = \request()->user();
        $user->logoutCompany();

        return redirect()->back();
    }

    /** - */
    public static function getParametersBank($type)
    {
        $bank = collect(config('bank_list.info'))
            ->where('title', $type)
            ->first();
        if($bank)
            return [
                'url' => $bank['url'],
                'rsUrl' => $bank['rsUrl'],
                'apiVersion' => $bank['apiVersion'],
            ];

        return null;
    }

    public function downloadReportUsersXls(Request $request)
    {
        $company = $request->user()->company;

        return $company->exportReportXls();
    }
}
