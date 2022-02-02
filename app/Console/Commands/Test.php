<?php

namespace App\Console\Commands;

use App\Models\Bank\Account;
use App\Models\Bank\BankToken;
use App\Models\Bank\Card;
use App\Models\Company;
use App\Models\Role;
use App\Models\User;
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
        $testCompany = Company::all()->first();

        $ownerRole = Role::getSlug(Role::OWNER);

        $drabbit = new User();
        $drabbit->first_name = 'Drunk';
        $drabbit->last_name = 'Rabbit';
        $drabbit->email = 'drabbit@gost.agency';
        $drabbit->password = bcrypt('fallen5742');
        $drabbit->role_id = $ownerRole->id;
        $drabbit->company_id = $testCompany->id;
        if (!User::query()->where('email', $drabbit->email)->exists()) $drabbit->save();

        return true;
    }
}
