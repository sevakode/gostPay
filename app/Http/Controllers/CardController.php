<?php

namespace App\Http\Controllers;

use App\Classes\BankContract\CardLimitContract;
use App\Classes\BankContract\GenerateCardsContract;
use App\Classes\BankMain;
use App\Classes\Tinkoff\BankAPI as TinkoffAPI;
use App\Interfaces\OptionsPermissions;
use App\Models\Bank\Account;
use App\Models\Bank\Card;
use App\Models\User;
use App\Notifications\DataNotification;
use Aspera\Spreadsheet\XLSX\Reader;
use Aspera\Spreadsheet\XLSX\SharedStringsConfiguration;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Notification as Notify;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

use Illuminate\Http\JsonResponse;
use Smalot\PdfParser\Parser;

class CardController extends Controller
{
    public function list()
    {
        $page_title = 'Все карты компании';
        $page_description = $page_title;

        $cards = Auth::user()->company->cards()->get();

        return view('pages.manager.widgets.cards', compact('cards','page_title', 'page_description'));
    }

    public function show($id, Request $request)
    {
        $card = Card::find($id);
        return view('pages.manager.widgets.card', compact('card'));
    }

    public function create()
    {
        $page_title = 'Создать карты';
        $page_description = $page_title;

        $cards = Auth::user()->company->cards()->get();
        return view('pages.manager.widgets.cards-create', compact('cards', 'page_title', 'page_description'));
    }

    public function generateCards(Request $request)
    {
        // проверка полей
        $request->validate([
            'count_card' => ['required', function($key, $count_card, $f) {
                $limit = 100;
                if ($count_card > $limit) {
                    $message = "количество карт должны быть меньше $limit";
                    DataNotification::sendErrors([$message]);
                    $f($message);
                }
                if ($count_card <= 0) {
                    $message = "Вы не указали количество карт";
                    DataNotification::sendErrors([$message]);
                    $f($message);
                }
            }],
            'invoice' => ['required', function($key, $invoice, $f) {
                if ($invoice <= 0) {
                    $message = "Пожалуйста, укажите счет, для которого нужно сгенерировать карты";
                    DataNotification::sendErrors([$message]);
                    $f($message, 404);
                }
                else if (! Account::where('account_id', $invoice)->exists()) {
                    $message = "Данного счет не существует";
                    DataNotification::sendErrors([$message]);
                    $f($message, 404);
                }
            }]
        ]);

        $account = Account::where('account_id', $request->invoice)->with('bank')->first(); //получаем аккаунт
        $bank = $account->getRelation('bank'); // обращаемся к банку счета
        if ($bank->api() instanceof GenerateCardsContract) { // проверяем, есть ли возможность генерировать карты
            $cards = $bank->api()->getCards()->collect(); // получаем список всех карт на счету

            $responseCards = $bank->api()->createCards($account, 1 ?? $request->count_card); // создаем карты
            // проверяем все карты и заносим в бд
            foreach ($responseCards->get('success', []) as $card) {
                $cardRequisite = (object) $card->get('requisite');
                dd($card);
                $cardQvx = $card->get('cardInfo')['qvx'];
                $cardInfo = $card->get('cardInfo')['info'];


                $cardModel = new Card();
                $cardModel->number = $cardRequisite->pan;
                $cardModel->ucid = $cardQvx['id'];
                $cardModel->cvc = $cardRequisite->cvv;
                $cardModel->state = Card::ACTIVE;
                $cardModel->expiredAt = Carbon::createFromFormat(DateTimeInterface::W3C, $cardQvx['cardExpire']);
                $cardModel->account_code = $request->invoice;
                $cardModel->bank_code = $cardInfo['name'];
                $cardModel->company_id = $request->user()->company->id;

                $cardModel->save();

                Notify::send($request->user(), DataNotification::success());
            }
//            foreach ([['transaction' => ['id' => 23983282870]]] as $card) {
//                // получаем подробную информацию о транзакции создания карты
//                $transactionCreatedCard = $bank->api()->getPaymentStatus($card['transaction']['id'])->object();
//                // выводим дату создания транзакции в объект Carbon
//                $transactionDate = Carbon::createFromFormat(DateTimeInterface::W3C, $transactionCreatedCard->date);
//                // получаем свободную карту
//                $cardAvailable = $cards->filter(function ($item) use ($transactionDate) {
//                    $activatedCardDate = Carbon::createFromFormat(DateTimeInterface::W3C, $item['qvx']['activated']);
//
//                    $where = $activatedCardDate->gt($transactionDate);
//                    return $where;
//                })->sortByDesc(function ($item) use ($transactionDate) {
//                    $activatedCardDate = Carbon::createFromFormat(DateTimeInterface::W3C, $item['qvx']['activated']);
//                    return $activatedCardDate->timestamp;
//                })->first(function ($item) use ($account, $bank, &$cardRequisite) {
//                    $cardRequisite = $bank->api()->getCardInfo($item['qvx']['id'])->object();
//                    $queryCards = Card::query()->where('account_code', $account->account_id);
//                    $queryCards = $bank->api()->searchCard($queryCards, $cardRequisite->pan);
//
//                    $card = collect();
//                    if ($queryCards) {
//                        $card = $queryCards->get()->filter(function (Card $card) use($cardRequisite) {
//                            return $card->numberFull == $cardRequisite->pan;
//                        });
//                    }
//
//                    return $card->isEmpty();
//                });
//                $cardRequisite = (object) $cardRequisite;
//                $cardQvx = $cardAvailable['qvx'];
//                $cardInfo = $cardAvailable['info'];
//
//
//                $cardModel = new Card();
//                $cardModel->number = $cardRequisite->pan;
//                $cardModel->ucid = $cardQvx['id'];
//                $cardModel->cvc = $cardRequisite->cvv;
//                $cardModel->state = Card::ACTIVE;
//                $cardModel->expiredAt = Carbon::createFromFormat(DateTimeInterface::W3C, $cardQvx['cardExpire']);
//                $cardModel->account_code = $request->invoice;
//                $cardModel->bank_code = $cardInfo['name'];
//                $cardModel->company_id = $request->user()->company->id;
//
//                $cardModel->save();
//
//                Notify::send($request->user(), DataNotification::success());
//            }
        }
    }

    public function sendCard(Request $request)
    {
        $invoices = $request->user()->company->invoices();

        if(strlen($request->number) < 16 or !is_numeric($request->number))
            return DataNotification::sendErrors(['Номер карты не валиден'], $request->user());
        if(strlen($request->cvc) < 3 or !is_numeric($request->cvc))
            return DataNotification::sendErrors(['CVC не валиден'], $request->user());
        if($request->date_month < 1 or $request->date_month > 12 or !is_numeric($request->date_month))
            return DataNotification::sendErrors(['Число месяца указано не верно'], $request->user());
        if(!is_numeric($request->date_year))
            return DataNotification::sendErrors(['Год указан не верно'], $request->user());
        if(!isset($request->invoice) and !$invoices->where('account_id', $request->invoice)->exists())
            return DataNotification::sendErrors(['Счет не указан'], $request->user());

        $cardAr = Card::getNumberSplit($request->number);
        $cards = Card::where('head', $cardAr[0])->where('tail', $cardAr[3]);
        foreach ($cards->get() as $card) {
            if($card->numberFull == $request->number)
                return DataNotification::sendErrors(['Такая карта уже существует'], $request->user());
            else return DataNotification::sendErrors(['head и tail карты совпадает!'], $request->user());
        }

        $expiredAt = Carbon::createFromFormat('m#y#d H', "$request->date_month-$request->date_year-1 00");
        try {
            $card = new Card();
            $card->number = $request->number;
            $card->cvc = $request->cvc;
            $card->state = Card::ACTIVE;
            $card->expiredAt = $expiredAt;
            $card->account_code = $request->invoice;
            $card->bank_code = '044525999';
            $card->company_id = $request->user()->company->id;
            $card->save();

            Notify::send($request->user(), DataNotification::success());
        }
        catch (\Exception $e) {
            DataNotification::sendErrors(['Файл зашифрован'], $request->user());
            dd($e->getMessage());
        }

    }

    public function sendPDF(Request $request): JsonResponse
    {
        if(!$request->file('pdf')) return DataNotification::sendErrors(['Файл не указан'], $request->user());

        try {
            $pdf = (new Parser())->parseFile($request->file('pdf')->getPathname());
            Card::parsePdf($pdf);
        }
        catch (\Exception $e) {
            DataNotification::sendErrors(['Файл зашифрован'], $request->user());
        }

        return new JsonResponse();
    }

    public function sendXLSX(Request $request)
    {
        if(!$request->file('xlsx')) return DataNotification::sendErrors(['Файл не указан'], $request->user());

        $options = array(
            'TempDir'                    => public_path(),
            'SkipEmptyCells'             => false,
            'ReturnDateTimeObjects'      => true,
            'SharedStringsConfiguration' => new SharedStringsConfiguration(),
            'CustomFormats'              => array(20 => 'hh:mm')
        );

        try {
            $xlsx = new Reader($options);
            $xlsx->open($request->file('xlsx')->getPathname());
            Card::parseXlsx($xlsx, $request->invoice);
        }
        catch (\Exception $e) {
            DataNotification::sendErrors(['Файл зашифрован'], $request->user());
            dd($e);
        }

        return new JsonResponse();
    }

    public function download(Request $request)
    {
        $user = $request->user();
        $isPermission = Route::is('profile_cards') or $user
            ->hasPermission(OptionsPermissions::MANAGER_ROLE_SET['slug']);

        $cardsChecked = $user->company->cards()->where('user_id', $request->id);

        if(!$cardsChecked->exists() or $isPermission) {
            DataNotification::sendErrors(['У вас недостаточно прав!'], $user);
            die;
        }

        $cardsChecked = $cardsChecked->whereIn('id', $request->cards);

        $txt = '';
        foreach ($cardsChecked->get() as $card) {
            $txt .= $card->numberFull;
            $txt .= " ";
            $txt .= $card->expiredAt->format('m/Y');
            $txt .= " ";
            $txt .= $card->cvc;
            $txt .= "\r\n";
        }
        $dirName = 'download/';
        $dirPath = public_path($dirName);
        $fileName = Str::random(10).'.txt';
        $fullPath = $dirPath.$fileName;
        $link = asset($dirName.$fileName);

        if(!File::isDirectory($dirPath)) File::makeDirectory($dirPath);
        File::put($fullPath, $txt);

        return new JsonResponse($link);
    }

    public function setLimit(Request $request)
    {
        $requestUser = $request->user();

        $card = $requestUser->company->cards()->find($request->id);
        $user = (isset($card->user_id) and $requestUser->id == $card->user_id) ?
            User::find($card->user_id) :
            $requestUser;
        if(! ((isset($card->user_id) and $requestUser->id == $card->user_id) or
            $requestUser->hasPermissionTo(OptionsPermissions::MANAGER_ROLE_SET['slug'])))
        {
            DataNotification::sendErrors(['У вас недостаточно прав!'], $request->user());

            return response()->view('pages.errors.error-1', [
                'code' => 500,
                'message' => 'У вас недостаточно прав!'
            ]);
        }

        $balanceUser = $user->balance()->getSum();
        $maxLimit = max($balanceUser, 0);

        if (is_null($card))
            return DataNotification::sendErrors(['Такой карты не существует!'], $request->user());
        if ($request->limit > $maxLimit)
            return DataNotification::sendErrors(["У вас нет прав на лимит выше $maxLimit!"], $request->user());
        if (!$card->bank()->first()->isBank(BankMain::TINKOFF_BIN))
            return DataNotification::sendErrors(["Для данного банка нельзя изменить лимит!"], $request->user());

        $bank = $card->bank()->first();

        if(is_null($card->ucid)) Card::refreshUcidApi();

        if ($bank->api() instanceof CardLimitContract) {
            if($maxLimit) return DataNotification::sendErrors(["На вашем счету $balanceUser!"], $request->user());

            $response = $bank->api()->editCardLimits($card->ucid, TinkoffAPI::$LIMIT_TYPE_IRREGULAR, $card->limit)->json();

            if(isset($response->errorMessage) or isset($response['errorMessage'])) {
                $errorMessage = $response->errorMessage ?? $response['errorMessage'];
                return DataNotification::sendErrors([$errorMessage], $request->user());
            }

            $card->limit = $request->limit;
            $card->save();

            Notify::send($request->user(), DataNotification::success());
        }

        return new JsonResponse(['limit' => $card->limit]);
    }
}
