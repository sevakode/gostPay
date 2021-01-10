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
        $managerRole = Role::getSlug(Role::MANAGER);
        $userMainRole = Role::getSlug(Role::MAIN_USER);
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
        $user2->company_id = $testCompany->id;
        $user2->save();

        $user3 = new User();
        $user3->first_name = 'User';
        $user3->last_name = '';
        $user3->email = 'user@user.user';
        $user3->password = bcrypt('user');
        $user3->role_id = $userRole->id;
        $user3->company_id = $testCompany->id;
        $user3->save();

        $user4 = new User();
        $user4->first_name = 'User';
        $user4->last_name = 'Main';
        $user4->email = 'main@user.user';
        $user4->password = bcrypt('user');
        $user4->role_id = $userMainRole->id;
        $user4->company_id = $testCompany->id;
        $user4->save();

        $user5 = new User();
        $user5->first_name = 'Manager';
        $user5->last_name = '';
        $user5->email = 'manager@manager.manager';
        $user5->password = bcrypt('manager');
        $user5->role_id = $managerRole->id;
        $user5->company_id = $testCompany->id;
        $user5->save();

        User::factory(10)->create(['company_id' => $testCompany->id, 'role_id' => $userRole->id]);
    }
}
