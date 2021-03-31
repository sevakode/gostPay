<?php

namespace App\Console\Commands;

use App\Models\Bank\Card;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Crypt;

class CardsCrypt extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cards:crypt';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Зашифровывает карты';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $cards = Card::select('id', 'number', 'cvc')->get();

        foreach ($cards as $card) {
            $number = $card->getAttributes()['number'];
            $cvc = $card->getAttributes()['cvc'];
            $numberSplitFirst = Card::getNumberSplit($number)[0];

            if(is_numeric($numberSplitFirst))
                $card->number = Crypt::encrypt($number);

            if(isset($cvc) and is_numeric($cvc))
                $card->cvc = Crypt::encrypt($cvc);

            $card->save();
        }


        return 0;
    }
}
