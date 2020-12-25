<?php

use Illuminate\Support\Facades\Auth;
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
Route::get('/login', [\App\Http\Controllers\LoginController::class, 'index'])->name('login');
Route::get('/login/sign-in', [\App\Http\Controllers\LoginController::class, 'signIn'])->name('sign_in');
Route::get('/login/sign-up', [\App\Http\Controllers\LoginController::class, 'signUp'])->name('sign_up');


// Demo routes
//Route::middleware('auth')->group(function () {

    Route::get('/', 'PagesController@index');
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

    Route::get('/profile/edit', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile_edit');

    // Quick search dummy route to display html elements in search dropdown (header search)
    Route::get('/quick-search', 'PagesController@quickSearch')->name('quick-search');
//});





