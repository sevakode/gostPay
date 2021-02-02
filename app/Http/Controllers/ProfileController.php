<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Notifications\DataNotification;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function showPersonalInformation()
    {
        $page_title = 'Мой профиль';
        $page_description = 'Настройки учетной записи и многое другое';

        $user = Auth::user();
        $cards = $user->cards()->get();

        return view('pages.profile.personal', compact('page_title', 'page_description', 'user', 'cards'));
    }

    public function showCards()
    {
        $page_title = 'Мои карты';
        $page_description = 'Просмотр и управление моих карт';

        $user = Auth::user();
        $cards = $user->cards()->get();

        return view('pages.profile.cards', compact('page_title', 'page_description', 'user', 'cards'));
    }

    public function updatePersonalInformation(Request $request)
    {
        $validator = $this->validator($request->all(), $request->user());
        if($validator->fails())
            DataNotification::sendErrors($validator->errors()->unique());
        $validator->validate();
        $isSuccessUpdate = $request->user()->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'telegram' => $request->telegram,
        ]);

        $file = $request->file('profile_avatar');

        if(isset($file))
            $request->user()
                ->image('avatar')
                ->make($file, 'images/profile/avatar/original/');

        if($isSuccessUpdate) Notification::send($request->user(), DataNotification::success());

        return $request->wantsJson()
            ? new JsonResponse([url($this->redirectPath())], 201)
            : redirect($this->redirectPath());
    }

    public function createUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'max:16'],
            'email' => ['nullable', 'required', 'string', 'email', 'max:255', 'unique:users,email']
        ]);
        if($validator->fails())
            DataNotification::sendErrors($validator->errors()->unique());
        $validator->validate();

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role_id' => Role::getSlug(Role::USER)->id,
            'password' => bcrypt($request->password),
            'company_id' => $request->user()->company_id,
        ]);

        $file = $request->file('profile_avatar');
        if(isset($file))
            $user->image('avatar')->make($file, 'images/profile/avatar/original/');
        Notification::send($request->user(), DataNotification::success());
        return $request->wantsJson()
            ? new JsonResponse([url($this->redirectPath())], 201)
            : redirect(route('dashboard'));
    }

    /**
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    private function validator(array $data, User $user)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'max:16'],
            'telegram' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'required', 'string', 'email', 'max:255', 'unique:users,email,'. $user->id]
        ]);
    }

    private function redirectPath()
    {
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo();
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
    }

    protected $redirectTo = RouteServiceProvider::PROFILE;

}
