<?php

namespace App\Http\Controllers;

use App\Notifications\DataNotification;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class ManagerController extends Controller
{
    public function devManager()
    {
        $page_title = 'Мой профиль';
        $page_description = 'Настройки учетной записи и многое другое';

        return view('pages.manager.dev', compact('page_title', 'page_description'));
    }

    public function dashboard()
    {
        $page_title = 'Мой профиль';
        $page_description = 'Настройки учетной записи и многое другое';

        return view('pages.manager.dashboard', compact('page_title', 'page_description'));
    }

    public function updatePermission(Request $request)
    {
        Notification::send($request->user(), DataNotification::success());

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect($this->redirectPath());
    }

    private function redirectPath()
    {
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo();
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
    }

    protected $redirectTo = RouteServiceProvider::MANAGER;
}
