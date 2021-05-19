<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @var Role $ownerRole
     * @return void
     */
    public function run()
    {
        $testCompany = Company::all()->first();

        $ownerRole = Role::getSlug(Role::OWNER);
        $demoRole = Role::getSlug(Role::DEMO);

        $user1 = new User();
        $user1->first_name = 'Sevakode';
        $user1->last_name = '';
        $user1->email = 'sevakode@gmail.com';
        $user1->password = bcrypt('Dd781993');
        $user1->role_id = $ownerRole->id;
        $user1->company_id = $testCompany->id;
        $user1->save();

        $demo = new User();
        $demo->first_name = 'Demo';
        $demo->last_name = '';
        $demo->email = 'demo@demo.demo';
        $demo->password = bcrypt('demo');
        $demo->role_id = $demoRole->id;
        $demo->company_id = $testCompany->id;
        $demo->save();

    }
}
