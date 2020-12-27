<?php

use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
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
Route::get('/login/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::post('/login/sign-up', [\App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('sign_up')->middleware('isAjax');;


// Demo routes
Route::middleware('auth')->group(function () {

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

    Route::prefix(RouteServiceProvider::PROFILE)->group(function () {
        Route::get('/', [ProfileController::class, 'showPersonalInformation'])->name('profile_show');
        Route::post('/update', [ProfileController::class, 'updatePersonalInformation'])->name('profile_update');
    });

    // Quick search dummy route to display html elements in search dropdown (header search)
    Route::get('/quick-search', 'PagesController@quickSearch')->name('quick-search');
});
