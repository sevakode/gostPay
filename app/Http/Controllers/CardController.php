<?php

namespace App\Http\Controllers;

use App\Models\Bank\Card;
use App\Notifications\DataNotification;
use Aspera\Spreadsheet\XLSX\Reader;
use Aspera\Spreadsheet\XLSX\SharedStringsConfiguration;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Notification as Notify;
use Illuminate\Support\Str;

use Illuminate\Http\JsonResponse;
use Smalot\PdfParser\Parser;

class CardController extends Controller
{
    public function show()
    {
        $page_title = 'Все карты компании';
        $page_description = $page_title;

        $cards = Auth::user()->company->cards()->get();

        return view('pages.manager.widgets.cards', compact('cards','page_title', 'page_description'));
    }

    public function create()
    {
        $page_title = 'Создать карты';
        $page_description = $page_title;

        $cards = Auth::user()->company->cards()->get();
        return view('pages.manager.widgets.cards-create', compact('cards', 'page_title', 'page_description'));
    }

    public function sendCard(Request $request)
    {
        if(strlen($request->number) < 16 or !is_numeric($request->number))
            return DataNotification::sendErrors(['Номер карты не валиден'], $request->user());
        if(strlen($request->cvc) < 3 or !is_numeric($request->cvc))
            return DataNotification::sendErrors(['CVC не валиден'], $request->user());
        if($request->date_month < 1 or $request->date_month > 12 or !is_numeric($request->date_month))
            return DataNotification::sendErrors(['Число месяца указано не верно'], $request->user());
        if(!is_numeric($request->date_year))
            return DataNotification::sendErrors(['Год указан не верно'], $request->user());

        $cardAr = Card::getNumberSplit($request->number);
        $cards = Card::where('head', $cardAr[0])->where('tail', $cardAr[3]);
        foreach ($cards->get() as $card) {
            if($card->numberFull == $request->number)
                return DataNotification::sendErrors(['Такая карта уже существует'], $request->user());
        }

        $expiredAt = Carbon::createFromFormat('m#y#d H', "$request->date_month-$request->date_year-1 00");
        try {
            $card = new Card();
            $card->number = $request->number;
            $card->cvc = $request->cvc;
            $card->expiredAt = $expiredAt;
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
            Card::parseXlsx($xlsx);
        }
        catch (\Exception $e) {
            DataNotification::sendErrors(['Файл зашифрован'], $request->user());
            dd($e);
        }

        return new JsonResponse();
    }

    public function card($id)
    {
        $card = Card::find($id);
        return view('pages.manager.widgets.card', compact('card'));
    }

    public function download(Request $request)
    {
        $cardsChecked = $request->user()->cards()->where('user_id', $request->id);

        if(!$cardsChecked->exists()) {
            DataNotification::sendErrors(['У вас недостаточно прав!'], $request->user());
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
}
