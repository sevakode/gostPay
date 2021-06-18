<?php

namespace App\Console\Commands;

use App\Models\Bank\Card;
use Illuminate\Console\Command;

class RefreshUcidCards extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cards:ucidRefresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Обновление статуса карт';

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
        return Card::refreshUcidApi();
    }
}
