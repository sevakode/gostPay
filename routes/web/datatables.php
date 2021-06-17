<?php

use App\Http\Controllers\DatatablesController;
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

Route::post('select-add-cards', [DatatablesController::class, 'selectAddCard'])
    ->name('datatables.select-add-cards');
