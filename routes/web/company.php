<?php

use App\Http\Controllers\Admin\AccountBankController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\InvoiceController;
use App\Interfaces\OptionsPermissions;
use Illuminate\Support\Facades\Route;

Route::get('/', [CompanyController::class, 'list'])->name('company.list')
    ->middleware('auth.permission:'.OptionsPermissions::ACCESS_TO_ALL_COMPANY['slug']);

Route::get('/login/{id}', [CompanyController::class, 'loginAndShow'])->name('company.login.get')
    ->middleware('auth.permission:'.OptionsPermissions::ACCESS_TO_ALL_COMPANY['slug']);

Route::post('/login', [CompanyController::class, 'login'])->name('company.login.post')
    ->middleware('auth.permission:'.OptionsPermissions::ACCESS_TO_ALL_COMPANY['slug'])
    ->withoutMiddleware('auth.demo')
    ->middleware('isAjax');

Route::get('/show/{id?}', [CompanyController::class, 'show'])->name('company.show')
    ->whereNumber('id');

Route::get('/create', [CompanyController::class, 'create'])->name('company.create.show')
    ->middleware('auth.permission:'.OptionsPermissions::ACCESS_TO_CREATE_COMPANY['slug']);

Route::post('/creating', [CompanyController::class, 'creating'])->name('company.create')
    ->withoutMiddleware('auth.demo')
    ->middleware('auth.permission:'.OptionsPermissions::ACCESS_TO_INSERT_COMPANY['slug']);

Route::delete('/closed', [CompanyController::class, 'destroy'])->name('company.delete')
    ->withoutMiddleware('auth.demo')
    ->middleware('auth.permission:'.OptionsPermissions::ACCESS_TO_INSERT_COMPANY['slug']);

Route::get('/logout', [CompanyController::class, 'logout'])->name('company.logout')
    ->middleware('auth.permission:'.OptionsPermissions::ACCESS_TO_LOGOUT_COMPANY['slug']);

Route::get('/edit', [CompanyController::class, 'edit'])->name('company.edit')
    ->middleware('auth.permission:'.OptionsPermissions::ACCESS_TO_UPDATE_COMPANY['slug']);

Route::post('/update', [CompanyController::class, 'update'])->name('company.update')
    ->withoutMiddleware('auth.demo')
    ->middleware('auth.permission:'.OptionsPermissions::ACCESS_TO_UPDATE_COMPANY['slug']);

Route::prefix('/download')->group(function () {
    Route::get('report/users/xls', [CompanyController::class, 'downloadReportUsersXls'])
        ->name('company.download.report.users.xls')
        ->middleware('auth.permission:'.OptionsPermissions::ADMIN_ROLE_SET['slug']);
});


Route::prefix('/invoices')->group(function () {
    Route::get('/', [InvoiceController::class, 'index'])
        ->name('invoices');
    Route::get('/edit', [InvoiceController::class, 'edit'])
        ->middleware('auth.permission:'.OptionsPermissions::ACCESS_TO_CREATE_COMPANY['slug'])
        ->middleware('auth.permission:'.OptionsPermissions::ACCESS_TO_EDIT_INVOICE['slug'])
        ->name('invoice.edit');
    Route::post('/insert', [InvoiceController::class, 'insert'])
        ->withoutMiddleware('auth.demo')
        ->middleware('auth.permission:'.OptionsPermissions::ACCESS_TO_INSERT_INVOICE['slug'])
        ->middleware('auth.permission:'.OptionsPermissions::ACCESS_TO_INSERT_COMPANY['slug'])
        ->name('invoice.insert');
    Route::get('/{account_id}', [InvoiceController::class, 'show'])
        ->name('invoice.show');
    Route::post('/ajax', [AccountBankController::class, 'sendCompanyList'])
        ->name('bank.company.account.list.ajax')
        ->middleware('isAjax');
});
