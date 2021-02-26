<?php

namespace App\Console\Commands;

use App\Models\Company;
use Illuminate\Console\Command;

class CheckCardsForUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cards:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $count = 0;
        foreach (Company::all() as $company)
            foreach ($company->users()->get() as $user)
                foreach ($user->cards()->has('payments', '!=', null)->get() as $card) {
                    $payments = $card->payments()->where('operationAt', '<=', $card->updated_at);
                    if($payments->count()) {
                        $card->exit();
                        $this->info("(EXIT) $card->number - $user->fullName");
                        $count += 1;
                    }
                }
        $this->info("$count карт исправлено");
        return 0;
    }
}
