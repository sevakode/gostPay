<?php

namespace App\Console\Commands;

use App\Models\Bank\Payment;
use App\Models\Bank\Statement;
use Illuminate\Console\Command;

class Payments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payment:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Обновляет счета';

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
//        Statement::refreshApi();
//        Payment::refreshApi();

        $this->info("Данные с банка обновлены");
        return 0;
    }
}
