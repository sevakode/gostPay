<?php

namespace App\Http\Controllers;

use App\Interfaces\OptionsPermissions;
use App\Models\Bank\Account;
use App\Notifications\DataNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification as Notify;

class InvoiceController extends Controller
{
    public function index()
    {
        $page_title = 'Список счетов компании';
        $page_description = $page_title;

        $invoices = request()->user()->company->invoices();

        $data = compact(
            'page_title',
            'page_description',
            'invoices'
        );

        return view('pages.invoice.widgets.dashboard', $data);
    }


    public function show($account_id)
    {
        $page_title = 'Список счетов компании';
        $page_description = $page_title;

        $invoices = request()->user()->company->invoices()->where('account_id', $account_id);

        if(!$invoices->exists())
            return response()->view('pages.errors.error-1', [
                'code' => 500,
                'message' => 'У вас недостаточно прав!'
            ]);

        $invoice = $invoices->first();

        $data = compact(
            'page_title',
            'page_description',
            'invoice'
        );

        return view('pages.invoice.widgets.show', $data);
    }

    public function edit()
    {
        $page_title = 'Добавление счета';
        $page_description = $page_title;

        $company = request()->user()->company;
        $invoices = $company->invoices();

        if(!$invoices->exists())
            return response()->view('pages.errors.error-1', [
                'code' => 500,
                'message' => 'У вас недостаточно прав!'
            ]);

        $data = compact(
            'page_title',
            'page_description',
            'invoices',
            'company'
        );;

        return view('pages.invoice.widgets.edit', $data);
    }

    public function insert(Request $request)
    {
        $company = $request->user()->company;

        $accounts = array();
        foreach ($request->account_id as $account)
        {
            $account['company_id'] = $company->id;
            $accounts[] = $account;
        }

        if($accounts[0] != null) {
            if($request->user()->hasPermission(OptionsPermissions::ACCESS_TO_ALL_COMPANY['slug'])) {
                Account::where('company_id', $company->id)
                    ->whereNotIn('account_id', array_column($accounts, 'account_id'))
                    ->delete();

                Account::upsert(
                    $accounts,
                    ['account_id', 'company_id'],
                    ['account_id', 'company_id']
                );
            }
            else {
                DataNotification::sendErrors(['У вас недостаточно прав для изменений счетов']);
            }
        }

        Notify::send($request->user(), DataNotification::success());

        return redirect()->back();
    }
}
