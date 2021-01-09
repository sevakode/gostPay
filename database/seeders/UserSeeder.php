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
        $adminRole = Role::getSlug(Role::ADMIN);
        $userRole = Role::getSlug(Role::USER);

        User::truncate();

        $user1 = new User();
        $user1->first_name = 'Developer';
        $user1->last_name = '';
        $user1->email = 'dev@dev.dev';
        $user1->password = bcrypt('dev');
        $user1->role_id = $ownerRole->id;
        $user1->company_id = $testCompany->id;
        $user1->save();

        $user2 = new User();
        $user2->first_name = 'Admin';
        $user2->last_name = '';
        $user2->email = 'admin@admin.admin';
        $user2->password = bcrypt('admin');
        $user2->role_id = $adminRole->id;
        $user2->save();


        User::factory(10)->create(['company_id' => $testCompany->id, 'role_id' => $userRole->id]);
    }
}
