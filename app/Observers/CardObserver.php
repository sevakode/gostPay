<?php

namespace App\Observers;

use App\Models\Bank\Card;
use Illuminate\Support\Facades\Crypt;

class CardObserver
{
    /**
     * Handle the Card "creating" event.
     *
     * @param  Card  $card
     * @return void
     */
    public function creating(Card $card)
    {
        $number = Card::getNumberSplit($card->numberFull);
        if(is_numeric(Card::getNumberSplit($card->numberFull)[0]))
            $card->number = Crypt::encrypt($card->numberFull);
        if(isset($card->cvc) and is_numeric($card->cvc))
            $card->cvc = Crypt::encrypt($card->cvc);

        $card->head = $number[0];
        $card->tail = $number[3];
    }
}
