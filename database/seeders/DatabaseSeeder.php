<?php

namespace Database\Seeders;

use App\Classes\TochkaBank\BankAPI;
use App\Models\Bank\Card;
use App\Models\Bank\Payment;
use App\Models\Bank\Statement;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(RegistrationRoleAndPermissionSeeder::class);
        $this->call(CompanySeeder::class);
        $this->call(UserSeeder::class);

        $this->call(TochkaBankSeeder::class);
//        $this->call(CardSeeder::class);
//        $this->call(StatementSeeder::class);
//        $this->call(PaymentSeeder::class);
    }
}
