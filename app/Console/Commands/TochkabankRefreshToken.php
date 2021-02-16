<?php

namespace App\Console\Commands;

use App\Models\Bank\BankToken;
use Illuminate\Console\Command;

class TochkabankRefreshToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tochkabank:refresh';

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
        $banks = BankToken::refreshAll();

        foreach ($banks as $bank){
            $this->info($bank->company()->first()->name);
            $this->info("Access token: $bank->accessToken");
            $this->info("Refresh token: $bank->refreshToken");
        }

        return 0;
    }
}
