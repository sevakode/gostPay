<?php

namespace App\Http\Controllers;

use App\Models\Bank\Card;
use App\Notifications\DataNotification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification as Notify;

class DatatablesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('product');
    }

    public function companyCards(Request $request): JsonResponse
    {
        $data = array();
        mb_parse_str(urldecode($request->getContent()), $filter);

        $cards = $request->user()->company->cards();

        if(isset($filter['query']['state']))
            $cards = $cards->where('state',(boolean) $filter['query']['state']);

        if(isset($filter['query']['type']) and $filter['query']['type'] !== '')
            $cards = $cards->where('user_id', $filter['query']['type']);

        if(isset($filter['query']['generalSearch']))
            $cards = $cards
                ->where('number', 'like', '%' . $filter['query']['generalSearch'] . '%')
                ->orWhere('card_type', 'like', '%' . $filter['query']['generalSearch'] . '%')
                ->orWhereHas('user', function (Builder $query) use($filter){
                    $query->where('first_name', 'like', '%' . $filter['query']['generalSearch'] . '%');
                    $query->orWhere('last_name', 'like', '%' . $filter['query']['generalSearch'] . '%');
                });
        foreach ($cards->get() as $card) {
            $data['data'][] = [
                'number' => $card->number,
                'numberLink' => route('card', $card->id),
                'user' => isset($card->user) ? $card->user->fullname : 'none',
                'userLink' => isset($card->user) ? route('user_cards', $card->user->id) : '#',
                'type' => $card->card_type,
                'state' => $card->state,
                'countPayments' => $card->getPayments()->count(),
                'expiredAt' => $card->expiredAt->format('M d, Y'),
                'amount' => $card->amount() .'₽',
            ];
        }

        return new JsonResponse($data);
    }

    public function userCards(Request $request): JsonResponse
    {
        $data = array();
        mb_parse_str(urldecode($request->getContent()), $filter);

        $cards = $request->user()->company->cards()->where('user_id', $filter['id']);

        if(isset($filter['query']['state']))
            $cards = $cards->where('state',(boolean) $filter['query']['state']);

        if(isset($filter['query']['generalSearch']))
            $cards = $cards
                ->where('number', 'like', '%' . $filter['query']['generalSearch'] . '%')
                ->orWhere('card_type', 'like', '%' . $filter['query']['generalSearch'] . '%')
                ->orWhereHas('user', function (Builder $query) use($filter){
                    $query->where('first_name', 'like', '%' . $filter['query']['generalSearch'] . '%');
                    $query->orWhere('last_name', 'like', '%' . $filter['query']['generalSearch'] . '%');
                });

        if(isset($filter['query']['countCards'])) {
            $countCards = $filter['query']['countCards'];
            $userId =  $filter['id'];

            $cardsNoUser = $request->user()->company->cards()->where('user_id', null);
            if($cardsNoUser->count() >= (integer)$countCards) {
                $cardsNoUser = $cardsNoUser->get()->shuffle()->forPage(1, $countCards);

                foreach ($cardsNoUser as $card) {
                    $card->user_id = $userId;
                    $card->save();
                }
                $cards = $request->user()->company->cards()->where('user_id', $userId);
                Notify::send($request->user(), DataNotification::success());
            }
            else {
                DataNotification::sendErrors(['Осталось ' .$cardsNoUser->count(). ' карт!']);
            }
        }

        if(isset($filter['query']['removeCards'])) {
            $removeCards = explode(',', $filter['query']['removeCards']);
            $userId = $filter['id'];
            $cardsChecked = $request->user()->company->cards()->where('user_id', $userId)->whereIn('id', $removeCards);
            $cardsChecked->update(['user_id'=>null]);
        }
        if(isset($filter['query']['listCartForAdding'])) {
            $userId =  $filter['id'];

            foreach ($filter['query']['listCartForAdding'] as $card) {
                $card = Card::find($card['id']);
                $card->user_id = $userId;
                $card->save();
            }
            Notify::send($request->user(), DataNotification::success());
        }

        $data['countCardsNoUser'] = (integer)$request->user()->company->cards()->where('user_id', null)->count();
        foreach ($cards->get() as $card) {
            $data['data'][] = [
                'id' => $card->id,
                'number' => $card->number,
                'numberLink' => route('card', $card->id),
                'user' => isset($card->user) ? $card->user->fullname : 'none',
                'userLink' => isset($card->user) ? route('user_cards', $card->user->id) : '#',
                'type' => $card->card_type,
                'state' => $card->state,
                'countPayments' => $card->getPayments()->count(),
                'expiredAt' => $card->expiredAt->format('M d, Y'),
                'amount' => $card->amount() .'₽',
            ];
        }

        return new JsonResponse($data);
    }

    public function selectAddCard(Request $request)
    {
        $cards = $request->user()->company->cards()->where('user_id', null);

        if($request->q)
            $cards = $cards->where('number', 'like', '%' . $request->q . '%');

        $data = ['items'];
        foreach ($cards->get() as $card) {
            $data['items'][] = [
                'id' => $card->id,
                'text' => $card->number,
            ];
        }

        return new JsonResponse($data);
    }
}
