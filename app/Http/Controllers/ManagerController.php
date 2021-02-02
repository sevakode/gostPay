<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\DataNotification;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class ManagerController extends Controller
{
    public function user($id)
    {
        $page_title = 'Профиль пользователя компании';
        $page_description = $page_title;

        $user = Auth::user()->company->users()->find($id);
        $cards = $user->cards()->get();

        return view('pages.manager.widgets.user',
            compact('page_title', 'page_description', 'cards', 'user'));
    }

    public function addUser()
    {
        $page_title = 'Добавление пользователя компании';
        $page_description = $page_title;

        return view('pages.manager.widgets.add-user', compact('page_title', 'page_description'));
    }

    public function dashboard()
    {
        $page_title = 'Управление пользователями';
        $page_description = $page_title;

        return view('pages.manager.widgets.dashboard', compact('page_title', 'page_description'));
    }

    public function updatePermission(Request $request)
    {
        Notification::send($request->user(), DataNotification::success());

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect($this->redirectPath());
    }

    public function updateRole(Request $request)
    {
        if(!($request->user_id and $request->role_id)) return DataNotification::sendErrors(['Что пошло не так']);

        $role = $request->user()->getRolesListForPermissions()->where('id', $request->role_id);
        if($role->isEmpty()) return DataNotification::sendErrors(['Такой роли не существует']);

        $user = $request->user()->companyUsers()->find($request->user_id);
        if(!$user) return DataNotification::sendErrors(['Такого пользователя не существует']);

        if(!request()->user()->getRolesListForPermissions()->where('id', $user->role_id)->first())
            return DataNotification::sendErrors(['У вас недостаточно прав']);

        $user->setRole($request->role_id);

        $data = [
            'user_id' => $request->user_id,
            'role' => $role->first()->name,
        ];

        return $request->wantsJson()
            ? new JsonResponse($data, 201)
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
