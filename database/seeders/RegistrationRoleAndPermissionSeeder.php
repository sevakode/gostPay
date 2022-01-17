<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class RegistrationRoleAndPermissionSeeder extends Seeder
{
    private array $user_role_owner_list = [
        [
            'email' => 'sevakode@gmail.com'
        ],
        [
            'email' => 'drabbit@gost.agency'
        ],
    ];

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


        foreach ($this->user_role_owner_list as $userData) {
            if (User::whereEmail($userData['email'])->exists())
            {
                $ownerRole = Role::getSlug(Role::OWNER);
                $user1 = User::whereEmail($userData['email'])->first();
                $user1->role_id = $ownerRole->id;
                $user1->save();
            }
        }

    }
}
