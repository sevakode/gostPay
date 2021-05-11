<?php

namespace App\Http\Controllers;

use App\Models\Bank\Card;
use App\Models\Permission;
use App\Notifications\DataNotification;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class ManagerController extends Controller
{
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

        $invoices = \request()->user()->company->invoices();

        return view(
            'pages.manager.widgets.dashboard',
            compact(
                'page_title',
                'page_description',
                'invoices'
            )
        );
    }

    public function closingList()
    {
        $page_title = 'Список карт в ожидании на закрытие';
        $page_description = $page_title;

        $cards = request()->user()->company->cards()->where('state', \App\Models\Bank\Card::PENDING)->get();

        return view('pages.manager.widgets.cards-closing-list',
            compact('page_title', 'page_description', 'cards'));
    }

    public function closingCard(Request $request)
    {
        $card = $request->user()->company->cards()->find($request->card_id);
        $card->state = $request->status == 'true' ? Card::CLOSE : Card::ACTIVE;
        $card->save();

        Notification::send(request()->user(), DataNotification::success());

        if ($card->user()->exists()) {
            $message = $card->state == Card::CLOSE ?
                DataNotification::success("Карта $card->number закрыта") :
                DataNotification::success("Карта $card->number не была одобрена на закрытие!");

            Notification::send($card->user()->first(), $message);
        }

        return new JsonResponse(['card_id' => $request->card_id]);
    }

    public function closingCardAll(Request $request)
    {
        $cards = $request->user()->company->cards()->where('state', Card::PENDING)->get();
        $cardsId = [];
        foreach ($cards as $card) {
            $card->state = $request->status == 'true' ? Card::CLOSE : Card::ACTIVE;
            $card->save();

            Notification::send(request()->user(), DataNotification::success());

            if ($card->user()->exists()) {
                $message = $card->state == Card::CLOSE ?
                    DataNotification::success("Карта $card->number закрыта") :
                    DataNotification::success("Карта $card->number не была одобрена на закрытие!");

//                Notification::send($card->user()->first(), $message);
            }
            $cardsId[] = $card->id;
        }

        return new JsonResponse(['card_id_list' => $cardsId]);
    }

    public function user($id)
    {
        $page_title = 'Профиль пользователя компании';
        $page_description = $page_title;

        $user = Auth::user()->company->users()->find($id);
        $cards = $user->cards()->get();

        return view('pages.manager.widgets.user',
            compact('page_title', 'page_description', 'cards', 'user'));
    }

    public function updatePermission(Request $request)
    {
        Notification::send($request->user(), DataNotification::success());

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect($this->redirectPath());
    }

    public function deleteUser(Request $request)
    {
        $user = $request->user()->companyUsers()->find($request->user_id);
        if(!request()->user()->hasPermission(Permission::ACCESS_TO_REMOVE_USERS['slug']) or !$user)
            return DataNotification::sendErrors(['У вас недостаточно прав']);

        $user->delete();

        $data = [
            'user_id' => $request->user_id,
        ];

        Notification::send($request->user(), DataNotification::success());

        return $request->wantsJson()
            ? new JsonResponse($data, 201)
            : redirect($this->redirectPath());
    }

    public function updateRole(Request $request)
    {
        if(!($request->user_id and $request->role_id)) return DataNotification::sendErrors(['Что пошло не так']);

        $role = $request->user()->getRolesListForPermissions()->where('id', $request->role_id);
        if($role->isEmpty()) return DataNotification::sendErrors(['Такой роли не существует']);

        $user = $request->user()->companyUsers()->find($request->user_id);
        if(!$user) return DataNotification::sendErrors(['Такого пользователя не существует']);

        if(!request()->user()->getRolesListForPermissions()->where('id', $request->role_id)->first())
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
