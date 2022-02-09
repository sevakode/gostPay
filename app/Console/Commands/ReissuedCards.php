<?php

namespace App\Console\Commands;

use App\Classes\BankContract\ReissuedCardContract;
use App\Models\Bank\Account;
use App\Models\Bank\BankToken;
use App\Models\Bank\Card;
use Illuminate\Console\Command;

class ReissuedCards extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cards:reissued';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'перевыпуск карт';

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
    public function handle()
    {

        BankToken::query()->get()->map(function (BankToken $bankToken) {
            if ($bankToken->isApiOfContract(ReissuedCardContract::class)) {
                $invoices = $bankToken->invoices()->select('account_id')
                    ->whereHas('queryCards', function ($query) {
                        $query->whereNotNull('correlation_id')->where('state', Card::CLOSE);
                    })->with('queryCards', function($query) {
                        $query->whereNotNull('correlation_id')->where('state', Card::CLOSE);
                    })
                ;

                $invoices->get()->map(function (Account $account) use ($bankToken) {
                    $newCards = $bankToken->api()->reissuedCard($account->queryCards);
                });
            }
        });

        return true;
    }
}
