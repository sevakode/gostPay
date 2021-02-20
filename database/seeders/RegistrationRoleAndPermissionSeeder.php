<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class RegistrationRoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Permission::ALL as $permission)
        {
            $roles = $permission['roles'] ?? [];
            $permission = Permission::getSlug($permission);
            foreach ($roles as $role) {
                $permission->roles()->attach(Role::getSlug($role));
            }
        }

        $ownerRole = Role::getSlug(Role::OWNER);
        $user1 = User::whereEmail('sevakode@gmail.com')->first();
        $user1->role_id = $ownerRole->id;
        $user1->save();

    }
}
