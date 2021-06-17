<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login/sign-in', [LoginController::class, 'login'])->name('sign_in')->middleware('isAjax');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::post('/login/sign-up', [RegisterController::class, 'register'])->name('sign_up')->middleware('isAjax');
