<?php

namespace App\Console\Commands;

use App\Models\Bank\Card;
use Illuminate\Console\Command;

class CheckCardsState extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cards:state';

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
        $cards = Card::where('state', '!=', Card::ACTIVE)->where('state', '!=', Card::PENDING)->where('state', '!=', Card::CLOSE);

        $cards->update(['state' => Card::ACTIVE]);

        return 0;
    }
}
