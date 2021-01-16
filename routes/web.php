<?php

use App\Classes\TochkaBank\TochkaBank;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Interfaces\OptionsPermissions;
use App\Interfaces\OptionsRole;
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

    Route::prefix('datatables')->group(function () {
        Route::post('company-cards', [\App\Http\Controllers\DatatablesController::class, 'companyCards'])
            ->name('datatables.company-cards');
        Route::post('user-cards', [\App\Http\Controllers\DatatablesController::class, 'userCards'])
            ->name('datatables.user-cards');
        Route::post('select-add-cards', [\App\Http\Controllers\DatatablesController::class, 'selectAddCard'])
            ->name('datatables.select-add-cards');
    });

    Route::get('/', 'PagesController@index')->name('home');
    Route::get('/datatables', 'PagesController@datatables');
    Route::get('/ktdatatables', 'PagesController@ktDatatables');
    Route::get('/select2', 'PagesController@select2');
    Route::get('/jquerymask', 'PagesController@jQueryMask');
    Route::get('/icons/custom-icons', 'PagesController@customIcons');
    Route::get('/icons/flaticon', 'PagesController@flaticon');
    Route::get('/icons/fontawesome', 'PagesController@fontawesome');
    Route::get('/icons/lineawesome', 'PagesController@lineawesome');
    Route::get('/icons/socicons', 'PagesController@socicons');
    Route::get('/icons/svg', 'PagesController@svg');

    Route::prefix(RouteServiceProvider::PROFILE)
        ->middleware('auth.permission:'.OptionsPermissions::ACCESS_TO_PROFILE['title'])
        ->group(function () {
        Route::get('/', [ProfileController::class, 'showPersonalInformation'])->name('profile_show');
        Route::get('/cards', [ProfileController::class, 'showCards'])->name('profile_cards');
        Route::post('/update', [ProfileController::class, 'updatePersonalInformation'])->name('profile_update')
            ->middleware('auth.demo');
        Route::post('/create', [ProfileController::class, 'createUser'])->name('profile_create')
            ->middleware('auth.demo');
    });

    Route::prefix(RouteServiceProvider::MANAGER)
        ->middleware('auth.permission:'.OptionsPermissions::ACCESS_TO_MANAGER['title'])
        ->middleware('auth.permission:'.OptionsPermissions::ACCESS_TO_ALL_USERS_COMPANY['title'])
        ->group(function () {
        Route::get('/', [ManagerController::class, 'dashboard'])->name('dashboard');
        Route::get('/user/{id}/cards', [ManagerController::class, 'user'])->name('user_cards');
        Route::get('/user/add', [ManagerController::class, 'addUser'])->name('add_user');
        Route::post('/permission_edit', [ManagerController::class, 'updatePermission'])->name('permission_update')
            ->middleware('auth.demo');
        Route::post('/permission_edit', [ManagerController::class, 'updateRole'])->name('role_update')
            ->middleware('auth.demo');
    });
    Route::prefix('/bank')
        ->middleware('auth.permission:'.OptionsPermissions::ACCESS_TO_MANAGER['title'])
        ->middleware('auth.permission:'.OptionsPermissions::ACCESS_TO_ALL_CARDS_COMPANY['title'])
        ->group(function () {
        Route::get('cards', [\App\Http\Controllers\CardController::class, 'show'])->name('cards');
        Route::get('cards/create', [\App\Http\Controllers\CardController::class, 'create'])->name('cards.create');
        Route::post('cards/create/pdf', [\App\Http\Controllers\CardController::class, 'sendPDF'])->name('cards.create.pdf');
        Route::post('cards/create/xlsx', [\App\Http\Controllers\CardController::class, 'sendXLSX'])->name('cards.create.xlsx');
        Route::get('card/{id}', [\App\Http\Controllers\CardController::class, 'card'])->name('card');
        Route::post('cards/download', [\App\Http\Controllers\CardController::class, 'download'])->name('cards.download.txt');
    });

    Route::prefix('api')->group(function () {
//        Route::get('register', [TochkaBankController::class, 'register']);
//        Route::get('tauth', [TochkaBankController::class, 'tokenAuth']);
    });

    Route::get('/quick-search', 'PagesController@quickSearch')->name('quick-search');
});
