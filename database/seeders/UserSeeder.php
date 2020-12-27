<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
        $user1->first_name = 'Developer';
        $user1->last_name = '';
        $user1->email = 'dev@dev.dev';
        $user1->password = bcrypt('dev');
        $user1->role_id = $developer->id;
        $user1->save();
        $user1->permissions()->attach($createTasks);

        $user2 = new User();
        $user2->first_name = 'Admin';
        $user2->last_name = '';
        $user2->email = 'admin@admin.admin';
        $user2->password = bcrypt('admin');
        $user2->role_id = $admin->id;
        $user2->save();

        $user2->permissions()->attach($manageUsers);
    }
}
