<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        $page_title = 'Мой профиль';
        $page_description = 'Настройки учетной записи и многое другое';

        return view('pages.login.default', compact('page_title', 'page_description'));
    }
}
