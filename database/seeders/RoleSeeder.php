<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        Role::truncate();
        $role = new Role();
        $role->name = 'Admin';
        $role->slug = Str::slug($role->name);
        $role->save();

        $role = new Role();
        $role->name = 'Developer';
        $role->slug = Str::slug($role->name);
        $role->save();
    }
}
