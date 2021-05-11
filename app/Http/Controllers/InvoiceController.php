<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

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
}
