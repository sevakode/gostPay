<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        $page_title = 'Мой профиль';
        $page_description = 'Настройки учетной записи и многое другое';

        return view('pages.profile.edit', compact('page_title', 'page_description'));
    }
}
