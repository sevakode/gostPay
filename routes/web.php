<?php

use App\Http\Controllers\Admin\AccountBankController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TochkaBankController;
use App\Interfaces\OptionsPermissions;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::post('/send-notification', [NotificationController::class, 'sendMessageNotification'])->middleware('isAjax');

Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login/sign-in', [\App\Http\Controllers\Auth\LoginController::class, 'login'])->name('sign_in')->middleware('isAjax');
Route::get('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::post('/login/sign-up', [\App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('sign_up')->middleware('isAjax');;


// Demo routes
Route::middleware('auth')->group(function () {

    Route::prefix('datatables')
        ->group(function () {

            Route::post('company-cards', [\App\Http\Controllers\DatatablesController::class, 'companyCards'])
                ->name('datatables.company-cards');

            Route::post('invoice-cards', [\App\Http\Controllers\DatatablesController::class, 'invoiceCards'])
                ->name('datatables.invoice-cards');

            Route::post('company-projects', [\App\Http\Controllers\DatatablesController::class, 'companyProjects'])
                ->name('datatables.company-projects');

            Route::post('company-project-cards', [\App\Http\Controllers\DatatablesController::class, 'companyProjectCards'])
                ->name('datatables.project-cards');

            Route::post('payment-chart', [\App\Http\Controllers\DatatablesController::class, 'paymentChart'])
                ->name('datatables.payment-chart');

            Route::post('user-cards', [\App\Http\Controllers\DatatablesController::class, 'userCards'])
                ->name('datatables.user-cards');

            Route::post('select-add-cards', [\App\Http\Controllers\DatatablesController::class, 'selectAddCard'])
                ->name('datatables.select-add-cards');
        });
    Route::prefix('charts')
        ->group(function () {
            Route::post('areas', [\App\Http\Controllers\ChartsController::class, 'area'])
                ->name('charts.areas');
        });
    Route::prefix('quick-panel')
        ->group(function () {
            Route::post('all-payment-list', [\App\Http\Controllers\QuickPanelController::class, 'userCards']);
        });

    Route::get('/', [PagesController::class, 'index'])->name('home');

    Route::prefix(RouteServiceProvider::ADMIN)
        ->middleware('auth.permission:'.OptionsPermissions::OWNER['slug'])
        ->group(function () {

            Route::prefix('/accounts')
                ->middleware('auth.permission:'.OptionsPermissions::OWNER['slug'])
                ->group(function () {
                    Route::get('/', [AccountBankController::class, 'list'])
                        ->name('bank.account.list');
                    Route::get('/create', [AccountBankController::class, 'create'])
                        ->name('bank.account.create');
                    Route::get('/{id}/edit', [AccountBankController::class, 'edit'])
                        ->name('bank.account.edit');
                    Route::post('/{id}/update', [AccountBankController::class, 'updating'])
                        ->name('bank.account.updating');
                    Route::post('/create', [AccountBankController::class, 'creating'])
                        ->name('bank.account.creating');
                    Route::delete('/delete', [AccountBankController::class, 'delete'])
                        ->name('bank.account.delete');
                });

            Route::post('/ajax', [AccountBankController::class, 'sendList'])
                ->name('bank.account.list.ajax')
//                ->middleware('auth.permission:'.OptionsPermissions::OWNER['slug'])
                ->middleware('isAjax');

            Route::get('/', [ProfileController::class, 'showPersonalInformation'])->name('profile_show');

            Route::post('/update', [ProfileController::class, 'updatePersonalInformation'])->name('profile_update')
                ->middleware('auth.demo');

            Route::post('/create', [ProfileController::class, 'createUser'])->name('profile_create')
                ->middleware('auth.demo');
        });

    Route::prefix(RouteServiceProvider::COMPANY)
        ->group(function () {
            Route::get('/', [CompanyController::class, 'list'])->name('company.list')
                ->middleware('auth.permission:'.OptionsPermissions::ACCESS_TO_ALL_COMPANY['slug']);

            Route::get('/login/{id}', [CompanyController::class, 'loginAndShow'])->name('company.login.get')
                ->middleware('auth.permission:'.OptionsPermissions::ACCESS_TO_ALL_COMPANY['slug']);

            Route::post('/login', [CompanyController::class, 'login'])->name('company.login.post')
                ->middleware('auth.permission:'.OptionsPermissions::ACCESS_TO_ALL_COMPANY['slug'])
                ->middleware('isAjax');

            Route::get('/show/{id?}', [CompanyController::class, 'show'])->name('company.show')
                ->whereNumber('id');

            Route::get('/create', [CompanyController::class, 'create'])->name('company.create.show')
                ->middleware('auth.permission:'.OptionsPermissions::ACCESS_TO_CREATE_COMPANY['slug']);

            Route::post('/creating', [CompanyController::class, 'creating'])->name('company.create')
                ->middleware('auth.permission:'.OptionsPermissions::ACCESS_TO_INSERT_COMPANY['slug']);

            Route::delete('/closed', [CompanyController::class, 'destroy'])->name('company.delete')
                ->middleware('auth.permission:'.OptionsPermissions::ACCESS_TO_INSERT_COMPANY['slug']);

            Route::get('/logout', [CompanyController::class, 'logout'])->name('company.logout')
                ->middleware('auth.permission:'.OptionsPermissions::ACCESS_TO_LOGOUT_COMPANY['slug']);

            Route::get('/edit', [CompanyController::class, 'edit'])->name('company.edit')
                ->middleware('auth.permission:'.OptionsPermissions::ACCESS_TO_UPDATE_COMPANY['slug']);

            Route::post('/update', [CompanyController::class, 'update'])->name('company.update')
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
                    ->name('invoice.edit');
                Route::post('/insert', [InvoiceController::class, 'insert'])
                    ->middleware('auth.permission:'.OptionsPermissions::ACCESS_TO_INSERT_COMPANY['slug'])
                    ->name('invoice.insert');
                Route::get('/{account_id}', [InvoiceController::class, 'show'])
                    ->name('invoice.show');
                Route::post('/ajax', [AccountBankController::class, 'sendCompanyList'])
                    ->name('bank.company.account.list.ajax')
                    ->middleware('isAjax');
            });
        });

    Route::prefix(RouteServiceProvider::PROFILE)
        ->middleware('auth.permission:'.OptionsPermissions::ACCESS_TO_PROFILE['slug'])
        ->group(function () {

            Route::get('/', [ProfileController::class, 'showPersonalInformation'])->name('profile_show');

            Route::get('/cards', [ProfileController::class, 'showCards'])->name('profile_cards');

            Route::post('/update', [ProfileController::class, 'updatePersonalInformation'])->name('profile_update')
                ->middleware('auth.demo');

            Route::post('/create', [ProfileController::class, 'createUser'])->name('profile_create')
                ->middleware('auth.demo');
        });

    Route::prefix(RouteServiceProvider::MANAGER)
        ->middleware('auth.permission:'.OptionsPermissions::ACCESS_TO_MANAGER['slug'])
        ->middleware('auth.permission:'.OptionsPermissions::ACCESS_TO_ALL_USERS_COMPANY['slug'])
        ->group(function () {

            Route::get('/', [ManagerController::class, 'dashboard'])->name('dashboard');

            Route::get('/user/{id}/cards', [ManagerController::class, 'user'])->name('user_cards');

            Route::get('/user/add', [ManagerController::class, 'addUser'])->name('add_user');

            Route::get('/cards/closing_list', [ManagerController::class, 'closingList'])->name('cards_closing_list');

            Route::post('/permission_edit', [ManagerController::class, 'updatePermission'])->name('permission_update')
                ->middleware('auth.demo');

            Route::post('/permission_edit', [ManagerController::class, 'updateRole'])->name('role_update')
                ->middleware('auth.demo');

            Route::post('/user_delete', [ManagerController::class, 'deleteUser'])->name('user_delete')
                ->middleware('auth.demo');

            Route::post('/cards/closing', [ManagerController::class, 'closingCard'])->name('cards_closing')
                ->middleware('auth.demo');

            Route::post('/cards/closing-all', [ManagerController::class, 'closingCardAll'])->name('cards_closing_all')
                ->middleware('auth.demo');
        });


    Route::prefix(RouteServiceProvider::BANK)
        ->middleware('auth.permission:'.OptionsPermissions::ACCESS_TO_MANAGER['slug'])
        ->middleware('auth.permission:'.OptionsPermissions::ACCESS_TO_ALL_CARDS_COMPANY['slug'])
        ->group(function () {

            Route::get('card/{id}', [\App\Http\Controllers\CardController::class, 'card'])->name('card');
            Route::prefix('/cards')->group(function () {
                Route::get('/', [\App\Http\Controllers\CardController::class, 'show'])->name('cards');

                Route::get('/create', [\App\Http\Controllers\CardController::class, 'create'])
                    ->name('cards.create');

                Route::post('/create/pdf', [\App\Http\Controllers\CardController::class, 'sendPDF'])
                    ->name('cards.create.pdf')
                    ->withoutMiddleware('auth.permission:'.OptionsPermissions::ACCESS_TO_CREATE_CARDS['slug']);

                Route::post('/create/xlsx', [\App\Http\Controllers\CardController::class, 'sendXLSX'])
                    ->name('cards.create.xlsx')
                    ->withoutMiddleware('auth.permission:'.OptionsPermissions::ACCESS_TO_CREATE_CARDS['slug']);

                Route::post('/create', [\App\Http\Controllers\CardController::class, 'sendCard'])
                    ->name('cards.create')
                    ->withoutMiddleware('auth.permission:'.OptionsPermissions::ACCESS_TO_CREATE_CARDS['slug']);

                Route::post('/download', [\App\Http\Controllers\CardController::class, 'download'])
                    ->name('cards.download.txt')
                    ->withoutMiddleware('auth.permission:'.OptionsPermissions::ACCESS_TO_MANAGER['slug'])
                    ->withoutMiddleware('auth.permission:'.OptionsPermissions::ACCESS_TO_ALL_CARDS_COMPANY['slug']);
            });
        });

    Route::prefix(RouteServiceProvider::PROJECTS)->group(function () {
        Route::get('/', [\App\Http\Controllers\ProjectController::class, 'list'])->name('projects')
            ->middleware('auth.permission:'.OptionsPermissions::ACCESS_TO_ALL_PROJECTS_COMPANY['slug']);

        Route::get('create', [\App\Http\Controllers\ProjectController::class, 'create'])
            ->name('projects.create')
            ->middleware('auth.permission:'.OptionsPermissions::ACCESS_TO_CREATE_PROJECTS_COMPANY['slug']);
        Route::post('creating', [\App\Http\Controllers\ProjectController::class, 'creating'])
            ->name('projects.creating')
            ->middleware('auth.permission:'.OptionsPermissions::ACCESS_TO_CREATE_PROJECTS_COMPANY['slug']);

        Route::get('{slug}/edit', [\App\Http\Controllers\ProjectController::class, 'update'])
            ->name('projects.edit')
            ->middleware('auth.permission:'.OptionsPermissions::ACCESS_TO_UPDATE_PROJECTS_COMPANY['slug']);
        Route::post('{slug}/updating', [\App\Http\Controllers\ProjectController::class, 'updating'])
            ->name('projects.updating')
            ->middleware('auth.permission:'.OptionsPermissions::ACCESS_TO_UPDATE_PROJECTS_COMPANY['slug']);

        Route::get('{slug}/show', [\App\Http\Controllers\ProjectController::class, 'show'])
            ->name('projects.show')
            ->middleware('auth.permission:'.OptionsPermissions::ACCESS_TO_SHOW_PROJECTS_COMPANY['slug']);
    });

    Route::prefix('api')->group(function () {
//        Route::get('register', [TochkaBankController::class, 'register']);
        Route::get('tauth/{key}', [TochkaBankController::class, 'tokenAuth'])->name('api.tauth');
    });

    Route::get('/quick-search', 'PagesController@quickSearch')->name('quick-search');
});
