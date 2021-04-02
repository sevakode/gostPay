<?php

namespace App\Http\Controllers;

use App\Models\Bank\Card;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('product');
    }

    public function sendMessageNotification(Request $request): JsonResponse
    {
        $notify = $request->user()->unreadNotifications;
        $notify->markAsRead();

        return new JsonResponse($notify);
    }
    public function sendMessageTelegramNotification()
    {
        dd(Card::select('id')->get()->unreadNotifications);

        return new JsonResponse('$notify');
    }


}
