<?php

namespace App\Http\Controllers;

use App\Interfaces\OptionsPermissions;
use App\Models\Bank\Account;
use App\Models\Bank\BankToken;
use App\Models\Bank\Card;
use App\Models\Bank\Payment;
use App\Models\Bank\TransactionBalance;
use App\Models\Company;
use App\Models\User;
use App\Notifications\DataNotification;
use App\Notifications\TelegramNotification;
use App\Providers\RouteServiceProvider;
use App\Traits\TableCards;
use App\Traits\TableProjects;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Notification as Notify;
use Illuminate\Support\Str;

class DatatablesController extends Controller
{
    use TableCards, TableProjects;

    public function index()
    {
        return view('product');
    }

    /**
     * Invoice Cards --------------------------------------------------------------------------------------
     * @param Request $request
     * @return JsonResponse
     */

    public function paymentsRefresh(Request $request): JsonResponse
    {
        Payment::refreshApi();

        $user = $request->user();
        $company = $user->company;
        $invoices = $company->invoices()->select(['id', 'avail', 'currency'])->get();
        $invoices = $invoices->map(function (Account $invoice) {
            $invoice->currencySign = $invoice->getCurrencySignAttribute();

            return $invoice;
        });

        return new JsonResponse($invoices);
    }

    public function invoiceCards(Request $request): JsonResponse
    {
        $data = array();
        mb_parse_str(urldecode($request->getContent()), $filter);
        $invoices = $request->user()->company->invoices()->where('account_id', $filter['account_id']);
        $cards = $invoices->cards();

        if (isset($filter['sort']) and count($filter['sort']) == 2) {
            $this->sortNumber($cards, $filter);
            $this->sortUpdateAt($cards, $filter);
        }
        if (isset($filter['query'])) {
            $this->filterSearch($cards, $filter);
            $this->filterStatus($cards, $filter);
            $this->filterUsers($cards, $filter);
        }

        $cards = $cards->get()->where('company_id', $request->user()->company()->select('id')->first()->id);
        foreach ($cards as $card) {
            $updateAtPayments = $card->payments()->latest('updated_at')->first();
            $data['data'][] = [
                'number' => $card->number,
                'numberLink' => route('card', $card->id),
                'user' => isset($card->user) ? $card->user->fullname : 'none',
                'userLink' => isset($card->user) ? route('user_cards', $card->user->id) : '#',
                'type' => $card->card_type,
                'state' => $card->state,
                'project' => $card->project->name ?? 'none',
                'expiredAt' => $card->expiredAt->format('M d, Y'),
                'amount' => $card->amount() . $card->currencySign,
                'issue_at' => $card->issue_at ? $card->issue_at->format('M d, Y') : 'none',
            ];
        }
        if (isset($data['data'])) {
            $data['data'] = $this->getSort(collect($data['data']), $filter);
        }


        return new JsonResponse($data);
    }

    /**
     * Company Cards --------------------------------------------------------------------------------------
     * @param Request $request
     * @return JsonResponse
     */
    public function companyCards(Request $request): JsonResponse
    {
        $data = array();
        mb_parse_str(urldecode($request->getContent()), $filter);

        $cards = $request->user()->company->cards();

        if (isset($filter['sort']) and count($filter['sort']) == 2) {
            $this->sortNumber($cards, $filter);
        }
        else {
            $filter['sort'] = ['field' => 'created_at', 'sort' => 'desc'];
        }
        $this->sortUpdateAt($cards, $filter);

        if (isset($filter['query'])) {
            $this->filterSearch($cards, $filter);
            $this->filterStatus($cards, $filter);
            $this->filterUsers($cards, $filter);
        }

        $cards = $cards->get()->where('company_id', $request->user()->company()->select('id')->first()->id);
        foreach ($cards as $card) {
            $updateAtPayments = $card->payments()->latest('updated_at')->first();
            $data['data'][] = [
                'number' => $card->number,
                'numberLink' => route('card', $card->id),
                'user' => isset($card->user) ? $card->user->fullname : 'none',
                'userLink' => isset($card->user) ? route('user_cards', $card->user->id) : '#',
                'type' => $card->card_type,
                'state' => $card->state,
                'project' => $card->project->name ?? 'none',
                'expiredAt' => $card->expiredAt->format('M d, Y'),
                'amount' => $card->amount() . $card->currencySign,
                'issue_at' => $card->issue_at ? $card->issue_at->format('M d, Y') : 'none',
            ];
        }

        $data['data'] = $this->getSort(collect($data['data']), $filter);

        return new JsonResponse($data);
    }

    public function payments(Request $request)
    {
        mb_parse_str(urldecode($request->getContent()), $filter);
        $request->offsetSet('page', $filter['pagination']['page']);
        $data['data'] = [];
        $data['meta'] = [
            "perpage"=> $filter['pagination']['perpage'] ?: 10,
        ];

        $user = $request->user();
        $isAdmin = $user->hasPermission(OptionsPermissions::MANAGER_ROLE_SET['slug']);

        if ($isAdmin) {
            $company = $user->company()->first();
            $cards = $company->cards();
        }
        else{
            $cards = $user->cards();
        }
        if(isset($filter['query']['generalSearch'])) {
            $this->filterSearch($cards, $filter);
            $cards->orWhereHas('user', function (Builder $query) use($filter) {
                $query->where('first_name', $filter['query']['generalSearch']);
                $query->orWhere('last_name', $filter['query']['generalSearch']);
                $query->orWhereRaw('first_name + last_name', $filter['query']['generalSearch']);
            });
        }
        if(isset($filter['query']['user_id'])) {
            $cards->where('user_id', $filter['query']['user_id']);
        }

        $paymentList = Payment::query()
            ->whereIn('card_id', $cards->get(['id'])->pluck('id'))
            ->join('cards', 'payments.card_id', '=', 'cards.id')
            ->with('queryCard', function($query) {
                $query->select(['id','state','user_id', 'number', 'head', 'tail']);
            });

        if(isset($filter['query']['generalSearch'])) {
            $paymentList->orWhere('amount', $filter['query']['generalSearch']);
        }

        switch ($filter['sort']['field'] ?? '') {
            case 'number':
                $paymentList->orderBy('cards.tail', $filter['sort']['sort'])
                    ->orderBy('cards.head', $filter['sort']['sort']);
                break;
            case 'description':
                $paymentList->orderBy('payments.description', $filter['sort']['sort']);
                break;
            case 'amount':
                $paymentList->orderBy('payments.amount', $filter['sort']['sort']);
                break;
            case 'operation_at':
                $paymentList->orderBy('operationAt', $filter['sort']['sort']);
                break;
            default:
                $paymentList->orderBy('operationAt', 'desc');
                break;
        }
        $paymentList = $paymentList->paginate($data['meta']['perpage']);

        $data['meta']['page'] = $paymentList->currentPage();
        $data['meta']['total'] = $paymentList->total();
        foreach ($paymentList as $payment) {
            $card = $payment->queryCard;
            $data['data'][] = [
                'number' => $card->number,
                'numberLink' => route('card', $card->id),
                'user' => isset($card->user) ? $card->user->fullname : 'none',
                'userLink' => isset($card->user) ? route('user_cards', $card->user->id) : '#',
                'state' => $card->state,

                'description' => $payment->description,
                'operation_at' => $payment->operationAt->format('M d, Y H:m'),
                'amount' => $payment->amount,
                'currency' => $card->currencySign,
                'type' => $payment->type,
            ];

        }

        return new JsonResponse($data);
    }

    public function accountTransactions(Request $request, $bank)
    {
        mb_parse_str(urldecode($request->getContent()), $filter);
        if(isset($filter['query']) and isset($filter['query']['eventPayCompany'])) {

            if ($request->user()->hasPermissionTo(OptionsPermissions::ACCESS_TO_REVENUE_BALANCE_FOR_COMPANY['slug'])) {
                $pay = (object) $filter['query']['eventPayCompany'];
                $company = Company::find($pay->company[0]['id']);

                $floatAmount = substr($pay->amount, -2);
                $intAmount = substr($pay->amount,  0,strlen($pay->amount)-2);
                $amount = (float)"$intAmount.$floatAmount";

                if ($company) {
                    $transactionObject = TransactionBalance::query()->create(['amount'=>$amount]);
                    $withPivot = [
                        'bank_account_id' => $pay->account[0]['id']
                    ];
                    $company->balance()->attach($transactionObject, $withPivot);
                    DataNotification::sendSuccess(['Транзакция прошла успешно']);
                }
                else {
                    DataNotification::sendErrors(['Компания не найдена'], $request->user());
                }
            }
            else {
                DataNotification::sendErrors(['У вас недостаточно прав для изменения баланса в компании']);
            }
        }

        $bank = BankToken::query()->find($bank);
        $invoices = $bank->invoices()->has('balance')->get();
        $transactions = collect();
        foreach ($invoices as $invoice) {

            $invoiceTransactions = $invoice->balance()->select('amount', 'message','transaction_balances.created_at','message', 'user_id as user_id')->get();

            if(isset($filter['query']['generalSearch'])) {
                $invoiceTransactions = $invoiceTransactions->whereHas('user', function (Builder $query) use($filter) {
                    $query->where('first_name', $filter['query']['generalSearch']);
                    $query->orWhere('last_name', $filter['query']['generalSearch']);
                    $query->orWhereRaw('first_name + last_name', $filter['query']['generalSearch']);
                });
            }
            $transactions = $transactions->merge($invoiceTransactions);
        }
        $request->offsetSet('page', $filter['pagination']['page']);
        $data['data'] = [];
        $data['meta'] = [
            "perpage"=> $filter['pagination']['perpage'] ?? 10,
            "total"=> 350,
        ];

        $user = $request->user();

        if(isset($filter['query']['company_id'])) {
            $transactions->where('company_id', $filter['query']['company_id']);
        }

        $page = $filter['pagination']['page'] -1 ?? 0;
        switch ($filter['sort']['field'] ?? '') {

        }
        $page = max($request->page, 1) - 1;
        $transactionsList = $transactions->chunk($data['meta']['perpage']);
        $data['pages'] = $transactionsList;

        $data['meta']['page'] = $page;
        foreach ($transactionsList[$page] as $transaction) {
            $account = $transaction->pivot->pivotParent;
            $company = $account->company()->first();
            $user = User::query()->addSelect(['first_name', 'last_name'])->find($transaction->user_id);

            $data['data'][] = [
                'company_name' => $company->name,
                'numberLink' => '#',
                'user' => $user->fullName ?? 'none',
                'userLink' => $transaction->user_id,

                'description' => $transaction->message ?? 'none',
                'operation_at' => $transaction->created_at->format('M d, Y H:m'),
                'amount' => $transaction->amount,
                'currency' => $account->currencySign,
                'type' => $transaction->type(),
            ];
//
        }
//
        return new JsonResponse($data);
    }

    public function accountCompanies(Request $request, $bank)
    {
        mb_parse_str(urldecode($request->getContent()), $filter);
        $bank = BankToken::query()->find($bank);

        $companies = $bank->companies();
        if($request->q) {
            $companies->where('name', 'LIKE', '%'.$request->q.'%');
        }

        $data = ['items'];

        foreach ($companies->get() as $company) {
            $data['items'][] = [
                'id' => $company->id,
                'text' => $company->name,
            ];
        }

        return new JsonResponse($data);
    }

    public function accounts(Request $request, $user_id)
    {
        $data = array();
        $companyQuery = $request->user()->company()->whereHas('users', function ($query) use ($user_id) {
            $query->where('id', $user_id);
        });
        if (! $companyQuery->exists())
        {
            DataNotification::sendSuccess(['Пользователь не найден в компании']);
            return $data;
        }
        $company = $companyQuery->first();

        $invoices = $company->invoices();
        if($request->q) $invoices->where('account_id', 'LIKE', "%$request->q%");
        $invoices->has('balance')->with(['balance' => function($query) {
            $query->where('user_id', null);
        }]);
        $invoices = $invoices->with('bank')->get();

        $groupInvoices = $invoices->mapToGroups(function ($item) {
            $bank = $item->getRelation('bank');
            $transactions = $item->getRelation('balance');
            $balance = $transactions->sum('amount');

            return [
                'items' => [
                    'text' => "$bank->title - $balance$item->currencySign",
                     'children' => [
                         [
                             'id' => $item->id,
                             'text' => $item->account_id,
                             'currency' => $item->currencySign,
                             'balance' => (float)$balance,
                         ]
                     ]
                ]
            ];
        });

        $data = $groupInvoices->toArray();

        return new JsonResponse($data);
    }

    public function userTransactions(Request $request, $user_id)
    {
        $data = array();
        $companyQuery = $request->user()->company();

        $floatAmount = substr($request->amount, -2);
        $intAmount = substr($request->amount, 0, strlen($request->amount) - 2);
        $amount = (float)"$intAmount.$floatAmount";

        $isNoMoney = $companyQuery->first()->balance()->whereUser(null)->getSum() < $amount;
        if($isNoMoney) {
            DataNotification::sendErrors(['У вас недостаточно средств']);
            return $data;
        }

        $isSuccessTransaction = $companyQuery->transactionUser($amount, $request->account, $user_id);
        if (! $isSuccessTransaction)
        {
            DataNotification::sendErrors(['Что-то пошло не так']);
        }
    }

    public function accountCompaniesInvoices(Request $request, $bank_id, $company_id)
    {
        $invoices = Account::where('bank_token_id', $bank_id)->where('company_id', $company_id);

        $cards = $request->user()->company->cards()->where('user_id', null);
        if ($request->q)
            $cards = $cards
                ->where('state', Card::ACTIVE)->where('number', 'like', '%' . $request->q . '%')
                ->orWhere('tail', $request->q)->where('state', Card::ACTIVE)
                ->orWhere('head', $request->q)->where('state', Card::ACTIVE);

        $data = ['items'];

        foreach ($invoices->get() as $invoice) {
            $data['items'][] = [
                'id' => $invoice->id,
                'text' => $invoice->account_id,
                'currency' => $invoice->getCurrencySignAttribute()
            ];
        }

        return new JsonResponse($data);
    }

    public function userCards(Request $request)
    {
        // TODO: Почистить код!
        $data = array();
        mb_parse_str(urldecode($request->getContent()), $filter);
        if (!isset($filter['id'])) dd('error');

        $cards = $request->user()->company->cards()->where('user_id', $filter['id']);

        if (isset($filter['query']['date'])) {
            $date = $filter['query']['date'];
            $dateStart = Carbon::createFromFormat('m#d#Y', $date['start'])->setTime(0, 0, 0);
            $dateEnd = Carbon::createFromFormat('m#d#Y', $date['end'])->setTime(0, 0, 0);
            $dateEnd = $dateStart->getTimestamp() == $dateEnd->getTimestamp() ? $dateEnd->addDay() : $dateEnd;

            $cards = $cards->whereHas('payments', function (Builder $query) use ($dateStart, $dateEnd) {
                $query->where('operationAt', '>=', $dateStart);
                $query->where('operationAt', '<=', $dateEnd);
            });
        }
        $this->filterStatus($cards, $filter);

        $this->filterSearch($cards, $filter);

        if (!$request->user()->hasPermissionTo(OptionsPermissions::DEMO['slug'])) {
            if (isset($filter['query']['countCards']) and $filter['query']['countCards'] and $filter['query']['countCards']['count']) {
                $countCards = $filter['query']['countCards']['count'];
                $account_id = $filter['query']['countCards']['account_id'];

                $company = $request->user()->company;
                $project = $company->projects()->whereSlug($filter['query']['countCards']['project']);
                $invoice = $company->invoices()->whereAccountId($account_id);
                $userId = $filter['id'];

                if ($project = $project->first()) {
                    $cardsFree = $company->cards()->free();
                    if ($invoice->exists())
                        $cardsFree = $cardsFree->where('account_code', $account_id);

                    if ($cardsFree->count() >= (integer)$countCards) {
                        $cardsFree = $cardsFree->get()->shuffle()->forPage(1, $countCards);

                        foreach ($cardsFree as $card) {
                            $card->user_id = $userId;
                            $card->issue_at = now();
                            $card->save();

                            $project->cards()->attach($card->id);
                        }
                        $cards = $company->cards()->where('user_id', $userId);
                        Notify::send($request->user(), DataNotification::success());
                    } else {
                        DataNotification::sendErrors(['Осталось ' . $cardsFree->count() . ' карт!']);
                    }
                } else {
                    DataNotification::sendErrors(['Не указан проект для карт!']);
                }
            }
            if (isset($filter['query']['removeCards'])) {
                $removeCards = explode(',', $filter['query']['removeCards']);
                $userId = $filter['id'];
                $cardsChecked = $request->user()->company->cards()->where('user_id', $userId)->whereIn('id', $removeCards);

                foreach ($cardsChecked->get() as $card) $card->project()->detach();

                $cardsChecked->update(['user_id' => null, 'issue_at' => null]);
            }
            if (isset($filter['query']['closeCards'])) {
                $closeCards = explode(',', $filter['query']['closeCards']);
                $userId = $filter['id'];
                $cardsList = $request->user()->company->cards()->where('user_id', $userId)->whereIn('id', $closeCards);
                $cardsListGet = $cardsList->get();
                $cardsListActive = $cardsList->where('state', Card::ACTIVE);
                $isCardsExists = $cardsListActive->exists();

                $cardsListActive->update(['state' => Card::PENDING]);
                if ($isCardsExists)
                    Notify::send(\request()->user(), DataNotification::success("Запрос на закрытие карт, отправлен!"));
                else
                    DataNotification::sendErrors(["В списке выбранных нет открытых карт!"]);

                TelegramNotification::sendMessageClosingCards('-1001248516513', $cardsListGet);
            }
            if (isset($filter['query']['closeCardsRemove'])) {
                if (!$request->user()->hasPermissionTo(OptionsPermissions::ACCESS_TO_CLOSE_CARDS['slug'])) {
                    DataNotification::sendErrors(["У вас нет прав для осуществлений таких действий!"]);
                    return [];
                }
                $closeCardsRemove = explode(',', $filter['query']['closeCardsRemove']);
                $userId = $filter['id'];
                $cardsList = $request->user()->company->cards()->where('user_id', $userId)->whereIn('id', $closeCardsRemove);
                $cardsListGet = $cardsList->get();
                $cardsListActive = $cardsList->where('state', Card::ACTIVE);
                $isCardsExists = $cardsListActive->exists();

                if ($isCardsExists) {
                    $cardsListActive->closed();
                    Notify::send(\request()->user(), DataNotification::success("Карты закрыты!"));
                }
               else DataNotification::sendErrors(["В списке выбранных нет открытых карт!"]);

                TelegramNotification::sendMessageClosedCards('-1001248516513', $cardsListGet);
            }
            if (isset($filter['query']['downloadCardsTxt'])) {
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
                $fileName = Str::random(10) . '.txt';
                $fullPath = $dirPath . $fileName;

                if (!File::isDirectory($dirPath)) File::makeDirectory($dirPath);
                File::put($fullPath, $txt);

                return response()->download($fullPath)->deleteFileAfterSend();
            }
            if (isset($filter['query']['listCartForAdding']) and $filter['query']['listCartForAdding'] != null) {
                $userId = $filter['id'];
                $project = $request->user()->company->projects()->whereSlug($filter['query']['listCartForAdding']['project']);
                if ($project = $project->first()) {
                    foreach ($filter['query']['listCartForAdding']['cards'] as $card) {
                        $card = Card::find($card['id']);
                        $card->user_id = $userId;
                        $card->issue_at = now();
                        $card->save();

                        $project->cards()->attach($card->id);
                    }

                    Notify::send($request->user(), DataNotification::success());
                } else {
                    DataNotification::sendErrors(['Не указан проект для карт!']);
                }
            }
        }

        if (isset($filter['sort']) and count($filter['sort']) == 2) {
            $this->sortNumber($cards, $filter);
        }
        else {
            $filter['sort'] = ['field' => 'issue_at', 'sort' => 'desc'];
        }
        $this->sortUpdateAt($cards, $filter);

        $data['countCardsNoUser'] = (integer)$request->user()->company->cards()->free()->count();
        $data['amountAll'] = 0;

        $cards = $cards->get()
            ->where('company_id', $request->user()->company()->select('id')->first()->id)
            ->where('user_id', $filter['id']);

        foreach ($cards as $card) {
            $data['amountAll'] += $card->amount();
            $data['data'][] = [
                'id' => $card->id,
                'number' => $filter['access_cards'] ? $card->numberFull : $card->number,
                'numberLink' => route('card', $card->id),
                'user' => isset($card->user) ? $card->user->fullname : 'none',
                'userLink' => isset($card->user) ? route('user_cards', $card->user->id) : '#',
                'type' => $card->card_type,
                'state' => $card->state,
                'project' => $card->project->name ?? 'none',
                'expiredAt' => $card->expiredAt->format('M d, Y'),
                'amount' => $card->amount() . $card->currencySign,
                'issue_at' => $card->issue_at ? $card->issue_at->format('M d, Y') : 'none',
            ];
        }

        if (isset($data['data']))
            $data['data'] = $this->getSort(collect($data['data']), $filter);
        $cardCurrency = $cards->first();
        $data['amountAll'] .= $cardCurrency ? $cardCurrency->invoice()->select('currency')->first()->currencySign : '₽';

        return new JsonResponse($data);
    }

    public function selectAddCard(Request $request)
    {
        $cards = $request->user()->company->cards()->where('user_id', null);

        if ($request->q)
            $cards = $cards
                ->where('state', Card::ACTIVE)->where('number', 'like', '%' . $request->q . '%')
                ->orWhere('tail', $request->q)->where('state', Card::ACTIVE)
                ->orWhere('head', $request->q)->where('state', Card::ACTIVE);

        $data = ['items'];
        foreach ($cards->get()->where('company_id', $request->user()->company()->select('id')->first()->id) as $card) {
            $data['items'][] = [
                'id' => $card->id,
                'text' => $card->number,
            ];
        }

        return new JsonResponse($data);
    }


    /**
     * Company Projects --------------------------------------------------------------------------------------
     * @param Request $request
     * @return JsonResponse
     */
    public function companyProjects(Request $request): JsonResponse
    {
        $data = array();
        mb_parse_str(urldecode($request->getContent()), $filter);

        foreach ($request->user()->company->projects()->get() as $project) {
            $data['data'][] = [
                'name' => $project->name,
                'users' => $project->users()->count(),
                'cards' => $project->cards()->count(),
                'expense' => $project->getAmountAllCards() . 'p',
                'project_slug' => RouteServiceProvider::PROJECTS . '/' . $project->slug . '/' . 'show',
            ];
        }

        return new JsonResponse($data);
    }

    public function companyProjectCards(Request $request): JsonResponse
    {
        $data = array();
        mb_parse_str(urldecode($request->getContent()), $filter);
        if (!isset($filter['slug'])) dd('error');
        $cards = $request->user()->company->projects()->whereSlug($filter['slug'])->first()->cards();

        if (isset($filter['query']['date'])) {
            $date = $filter['query']['date'];
            $dateStart = Carbon::createFromFormat('m#d#Y', $date['start'])->setTime(0, 0, 0);
            $dateEnd = Carbon::createFromFormat('m#d#Y', $date['end'])->setTime(0, 0, 0);

            $cards = $cards->whereHas('payments', function (Builder $query) use ($dateStart, $dateEnd) {
                $query->where('updated_at', '>=', $dateStart);
                $query->where('updated_at', '<=', $dateEnd);
            });
        }

        $this->filterStatus($cards, $filter);

        if (isset($filter['query']['generalSearch']))
            $cards = $cards
                ->where('number', 'like', '%' . $filter['query']['generalSearch'] . '%')
                ->orWhere('card_type', 'like', '%' . $filter['query']['generalSearch'] . '%')
                ->orWhereHas('user', function (Builder $query) use ($filter) {
                    $query->where('first_name', 'like', '%' . $filter['query']['generalSearch'] . '%');
                    $query->orWhere('last_name', 'like', '%' . $filter['query']['generalSearch'] . '%');
                });

        if (isset($filter['sort']) and count($filter['sort']) == 2) {
            $this->sortNumber($cards, $filter);
            $this->sortUpdateAt($cards, $filter);
        }

        $data['countCardsNoUser'] = (integer)$request->user()->company->cards()->free()->count();
        $data['amountAll'] = 0;

        $cards = $cards->get()->where('company_id', $request->user()->company()->select('id')->first()->id);
        foreach ($cards as $card) {

            $data['amountAll'] += $card->amount();
            $data['data'][] = [
                'id' => $card->id,
                'number' => $card->number,
                'numberLink' => route('card', $card->id),
                'user' => isset($card->user) ? $card->user->fullname : 'none',
                'userLink' => isset($card->user) ? route('user_cards', $card->user->id) : '#',
                'type' => $card->card_type,
                'state' => $card->state,
                'project' => $card->project->name ?? 'none',
                'expiredAt' => $card->expiredAt->format('M d, Y'),
                'amount' => $card->amount() . $card->currencySign,
                'issue_at' => $card->issue_at ? $card->issue_at->format('M d, Y') : 'none',
            ];
        }

        $data['data'] = $this->getSort(collect($data['data']), $filter);

        $data['amountAll'] .= $cards->first()->invoices()->select('currency')->first()->currencySign;

        return new JsonResponse($data);
    }

    /**
     * Charts --------------------------------------------------------------------------------------
     * @param Request $request
     * @return JsonResponse
     */
    public function paymentChart(Request $request)
    {
        $data = [];
        $user = $request->user();
        $company = $user->company;

        $i = 0;

        foreach ($company->users()->get() as $user) {
            $cards = $user->cards();

            $data['users'][$i] = $user->fullName;

            $data['amount'][$i] = 0;
            foreach ($cards->get() as $card) {
                $data['amount'][$i] += $card->amount();
            }

            $i++;
        }

        $carts[] = $data;

        return new JsonResponse($data, 200);
    }
}
