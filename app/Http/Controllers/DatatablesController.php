<?php
namespace App\Http\Controllers;

use App\Interfaces\OptionsPermissions;
use App\Models\Bank\Card;
use App\Notifications\DataNotification;
use App\Traits\TableCards;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Notification as Notify;
use Illuminate\Support\Str;

class DatatablesController extends Controller
{
    use TableCards;

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

        if(isset($filter['sort']) and count($filter['sort']) == 2) {
            $this->sortNumber($cards, $filter);
            $this->sortUpdateAt($cards, $filter);
        }
        if(isset($filter['query']))
        {
            $this->filterSearch($cards, $filter);
            $this->filterStatus($cards, $filter);
            $this->filterUsers($cards, $filter);
        }

        foreach ($cards->get() as $card) {
            $updateAtPayments = $card->payments()->latest('updated_at')->first();
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
                'updated_at' => $updateAtPayments ?
                    $updateAtPayments->updated_at->format('M d, Y') :
                    $card->updated_at->format('M d, Y')
            ];
        }

        $data['data'] = $this->getSort(collect($data['data']), $filter);

        return new JsonResponse($data);
    }

    public function paymentChart(Request $request)
    {
        $data = [];
        $user = $request->user();
        $company = $user->company;

        $i = 0;
        foreach ($company->users()->get() as $user)
        {
            $cards = $user->cards();

            $data['users'][$i] = $user->fullName;

            $data['amount'][$i] = 0;
            foreach ($cards->get() as $card)
            {
                $data['amount'][$i] += $card->amount();
            }

            $i++;
        }
        return new JsonResponse($data, 200);
    }

    public function userCards(Request $request)
    {
        $data = array();
        mb_parse_str(urldecode($request->getContent()), $filter);
        if(!isset($filter['id'])) dd('error');
        $cards = $request->user()->company->cards()->where('user_id', $filter['id']);

        if(isset($filter['query']['date'])) {
            $date = $filter['query']['date'];
            $dateStart = Carbon::createFromFormat('m#d#Y', $date['start'])->setTime(0,0,0);
            $dateEnd = Carbon::createFromFormat('m#d#Y', $date['end'])->setTime(0,0,0);

            $cards = $cards->whereHas('payments', function (Builder $query) use($dateStart, $dateEnd){
                $query->where('updated_at', '>=', $dateStart);
                $query->where('updated_at', '<=', $dateEnd);
            });
        }

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


        if(!$request->user()->hasPermissionTo(OptionsPermissions::DEMO['title'])) {
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
            if(isset($filter['query']['downloadCardsTxt'])) {
                $downloadCardsTxt = explode(',', $filter['query']['downloadCardsTxt']);
                $userId = $filter['id'];
                $cardsChecked = $request->user()->company->cards()
                    ->where('user_id', $userId)
                    ->whereIn('id', $downloadCardsTxt);
                $txt = '';
                foreach ($cardsChecked->get() as $card) {
                    $txt .= $card->number;
                    $txt .= "\n";
                }
                $dirPath = public_path('download/');
                $fileName = Str::random(10).'.txt';
                $fullPath = $dirPath.$fileName;

                if(!File::isDirectory($dirPath)) File::makeDirectory($dirPath);
                File::put($fullPath, $txt);

                return response()->download($fullPath)->deleteFileAfterSend();
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
        }

        if(isset($filter['sort']) and count($filter['sort']) == 2) {
            $this->sortNumber($cards, $filter);
            $this->sortUpdateAt($cards, $filter);
        }

        $data['countCardsNoUser'] = (integer)$request->user()->company->cards()->where('user_id', null)->count();
        $data['amountAll'] = 0;

        foreach ($cards->get()->where('user_id', $filter['id']) as $card) {
            $updateAtPayments = $card->payments()->latest('updated_at')->first();

            $data['amountAll'] += $card->amount();
            $data['data'][] = [
                'id' => $card->id,
                'number' => $filter['access_cards'] ? $card->numberFull : $card->number,
                'numberLink' => route('card', $card->id),
                'user' => isset($card->user) ? $card->user->fullname : 'none',
                'userLink' => isset($card->user) ? route('user_cards', $card->user->id) : '#',
                'type' => $card->card_type,
                'state' => $card->state,
                'countPayments' => $card->getPayments()->count(),
                'expiredAt' => $card->expiredAt->format('M d, Y'),
                'amount' => $card->amount() .'₽',
                'updated_at' => $updateAtPayments ?
                    $updateAtPayments->updated_at->format('M d, Y') :
                    null,
            ];
        }

        $data['data'] = $this->getSort(collect($data['data']), $filter);

        $data['amountAll'] .= '₽';

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
