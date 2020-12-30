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
        foreach (Role::ALL as $permission)
        {
            $name = $permission[0];
            $slug = $permission[1] ?? false;

            $role = new Role();
            $role->name = $name;

            if($slug) {
                $role->slug = $slug;
            }
            $role->save();
        }
    }
}
