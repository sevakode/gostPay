<?php

namespace App\Console\Commands;

use App\Models\Company;
use Database\Factories\CardTestFactory;
use Illuminate\Console\Command;

class GenerateCards extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cards:generate';

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
        $factory = new CardTestFactory();

        $company = Company::updateOrCreate([
            'name' => 'TestCompany',
            'slug' => 'test-company'
        ]);

        $company->cards()->delete();
        if (!$company->cards()->exists()) {
            $cards = $factory->count(20)->create([
                'company_id' => $company->id
            ]);
        }

        return 0;
    }
}
