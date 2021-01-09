<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
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
            $permission = Permission::getSlug($permission);
            $roles = $role['permissions'] ?? [];
            foreach ($roles as $role) {
                $permission->roles()->attach(Role::getSlug($role));
            }
        }

    }
}
