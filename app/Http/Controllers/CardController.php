<?php

namespace App\Http\Controllers;

use App\Models\Bank\Card;
use App\Notifications\DataNotification;
use Aspera\Spreadsheet\XLSX\Reader;
use Aspera\Spreadsheet\XLSX\SharedStringsConfiguration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
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

    public function sendPDF(Request $request)
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
