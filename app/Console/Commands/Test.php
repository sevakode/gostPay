<?php

namespace App\Console\Commands;

use App\Models\Bank\Account;
use App\Models\Bank\BankToken;
use App\Models\Bank\Card;
use Faker\Provider\ru_RU\Payment;
use Illuminate\Console\Command;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'test';

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
        $card = Card::whereHead(5534)->whereTail(6773)->first();
        dd($card->unblock());

        return true;
    }
}
