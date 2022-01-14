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
        $this->cryptPassword($card);
        $this->cryptCvc($card);

        $number = Card::getNumberSplit($card->numberFull);
        $card->head = $number[0];
        $card->tail = $number[3];
    }

    public function updating(Card $card)
    {
        $this->cryptPassword($card);
        $this->cryptCvc($card);

        $number = Card::getNumberSplit($card->numberFull);
        $card->head = $number[0];
        $card->tail = $number[3];
    }

    private function cryptPassword(Card $card)
    {
        if(is_numeric(Card::getNumberSplit($card->numberFull)[0]))
            $card->number = Crypt::encrypt($card->numberFull);
    }

    private function cryptCvc(Card $card)
    {
        if(isset($card->cvc) and is_numeric($card->cvc))
            $card->cvc = Crypt::encrypt($card->cvc);
    }
}
