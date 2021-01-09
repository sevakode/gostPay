<?php

namespace Database\Seeders;

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
//        dd(User::all()->first()->role->name);
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(RegistrationRoleAndPermissionSeeder::class);
        $this->call(CompanySeeder::class);
        $this->call(UserSeeder::class);

        $this->call(TochkaBankSeeder::class);
        $this->call(CardSeeder::class);
        $this->call(PaymentSeeder::class);
    }
}
