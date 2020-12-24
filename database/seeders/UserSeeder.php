<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::where('slug','admin')->first();
        $developer = Role::where('slug', 'developer')->first();
        $createTasks = Permission::where('slug','test-1')->first();
        $manageUsers = Permission::where('slug','test-2')->first();

        User::truncate();

        $user1 = new User();
        $user1->first_name = 'Jhon';
        $user1->last_name = 'Deo';
        $user1->email = 'jhon@deo.com';
        $user1->password = bcrypt('secret');
        $user1->role_id = $admin->id;
        $user1->save();
        $user1->givePermissionsTo($manageUsers->slug);
        $user1->permissions()->attach($createTasks);

        $user2 = new User();
        $user2->first_name = 'Mike';
        $user2->last_name = 'Thomas';
        $user2->email = 'mike@thomas.com';
        $user2->password = bcrypt('secret');
        $user2->role_id = $developer->id;
        $user2->save();

        $user2->permissions()->attach($manageUsers);
    }
}
