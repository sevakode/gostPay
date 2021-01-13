<?php

namespace App\Http\Controllers;

use App\Models\Bank\Card;
use App\Models\Bank\Payment;
use App\Notifications\DataNotification;
use Carbon\Carbon;
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
        $cards = Auth::user()->company->cards()->get();
        return view('pages.manager.widgets.cards', compact('cards'));
    }

    public function create()
    {
        $cards = Auth::user()->company->cards()->get();
        return view('pages.manager.widgets.cards-create', compact('cards'));
    }

    public function sendPDF(Request $request)
    {
        if(!$request->file('file')) return DataNotification::sendErrors(['Файл не указан'], $request->user());

        try {
            $pdf = (new Parser())->parseFile($request->file('file')->getPathname());
            Card::parsePdf($pdf);
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
        $cardsChecked = $request->user()->company->cards()
            ->where('user_id', $request->id)
            ->whereIn('id', $request->cards);
        $txt = '';
        foreach ($cardsChecked->get() as $card) {
            $txt .= $card->numberFull;
            $txt .= "\n";
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
