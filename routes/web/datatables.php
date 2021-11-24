<?php

use App\Http\Controllers\DatatablesController;
use App\Interfaces\OptionsPermissions;
use Illuminate\Support\Facades\Route;

Route::post('company-cards', [DatatablesController::class, 'companyCards'])
    ->name('datatables.company-cards');

Route::post('invoice-cards', [DatatablesController::class, 'invoiceCards'])
    ->name('datatables.invoice-cards');

Route::post('company-projects', [DatatablesController::class, 'companyProjects'])
    ->name('datatables.company-projects');

Route::post('company-project-cards', [DatatablesController::class, 'companyProjectCards'])
    ->name('datatables.project-cards');

Route::post('payment-chart', [DatatablesController::class, 'paymentChart'])
    ->name('datatables.payment-chart');

Route::post('user-cards', [DatatablesController::class, 'userCards'])
    ->name('datatables.user-cards');

Route::post('payments', [DatatablesController::class, 'payments'])
    ->name('datatables.dashboard.payments');

Route::post('account/{account_id}/transactions', [DatatablesController::class, 'accountTransactions'])
    ->name('datatables.accounts.transactions')
    ->middleware('auth.permission:'.OptionsPermissions::ACCESS_TO_SHOW_BALANCE_FOR_COMPANY['slug'])
    ->middleware('auth.permission:'.OptionsPermissions::ACCESS_TO_SHOW_BALANCE_FOR_COMPANY_USERS['slug']);
Route::get('account/{account_id}/companies/select', [DatatablesController::class, 'accountCompanies'])
    ->name('datatables.accounts.companies');
Route::get('account/{account_id}/companies/{company_id}/invoices/select', [DatatablesController::class, 'accountCompaniesInvoices'])
    ->name('datatables.accounts.companies.invoices');

Route::post('select-add-cards', [DatatablesController::class, 'selectAddCard'])
    ->name('datatables.select-add-cards');
