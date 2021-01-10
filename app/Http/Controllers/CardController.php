<?php

namespace App\Http\Controllers;

use App\Models\Bank\Card;
use Illuminate\Support\Facades\Auth;

class CardController extends Controller
{
    public function cards()
    {
        $cards = Auth::user()->company->cards()->get();
        return view('pages.manager.widgets.cards', compact('cards'));
    }

    public function card($id)
    {
        $card = Card::find($id);
        return view('pages.manager.widgets.card', compact('card'));
    }
}
