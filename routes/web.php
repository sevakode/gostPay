<?php

use App\Http\Controllers\Admin\AccountBankController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\ChartsController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DatatablesController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\QuickPanelController;
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
// Notification routes
Route::post('/send-notification', [NotificationController::class, 'sendMessageNotification'])
    ->middleware('isAjax');

// Auth routes
Route::prefix('auth')->group(base_path('routes/auth.php'));

// Web routes
Route::middleware('auth')->group(function () {

    Route::get('/', [PagesController::class, 'index'])->name('home');

    /** Не активно
     * API
     */
    Route::prefix('api')->group(base_path('routes/web/api.php'));

    /**
     * Статистики используемые для карт, проектов и т.д.
     */
    Route::prefix('charts')->group(base_path('routes/web/charts.php'));

    /**
     * Таблицы
     */
    Route::prefix('datatables')->group(base_path('routes/web/datatables.php'));

    /**
     * Маршруты для управлением Админки
     */
    Route::prefix(RouteServiceProvider::ADMIN)
        ->middleware('auth.permission:'.OptionsPermissions::OWNER['slug'])
        ->group(base_path('routes/web/admin.php'));

    /**
     * Маршруты для управлением Банковским функционалом
     */
    Route::prefix(RouteServiceProvider::BANK)
        ->middleware('auth.permission:'.OptionsPermissions::ACCESS_TO_MANAGER['slug'])
        ->middleware('auth.permission:'.OptionsPermissions::ACCESS_TO_ALL_CARDS_COMPANY['slug'])
        ->group(base_path('routes/web/bank.php'));

    /**
     * Маршруты для управлением комппании
     */
    Route::prefix(RouteServiceProvider::COMPANY)->group(base_path('routes/web/company.php'));

    /**
     * Маршруты для управлением мененджментом
     */
    Route::prefix(RouteServiceProvider::MANAGER)
        ->middleware('auth.permission:'.OptionsPermissions::ACCESS_TO_MANAGER['slug'])
        ->middleware('auth.permission:'.OptionsPermissions::ACCESS_TO_ALL_USERS_COMPANY['slug'])
        ->group(base_path('routes/web/manager.php'));

    /**
     * Маршруты для управлением личного профиля
     */
    Route::prefix(RouteServiceProvider::PROFILE)
        ->middleware('auth.permission:'.OptionsPermissions::ACCESS_TO_PROFILE['slug'])
        ->group(base_path('routes/web/profile.php'));

    /**
     * Маршруты для управлением проектов
     */
    Route::prefix(RouteServiceProvider::PROJECTS)->group(base_path('routes/web/projects.php'));

    /**
     * хз, без него не работает :)
     */
    Route::get('/quick-search', 'PagesController@quickSearch')->name('quick-search');
});
