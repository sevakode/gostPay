<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\QueryException;
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
        foreach (Role::ALL as $role)
        {
            $name = $role['title'];
            $slug = $role['slug'] ?? false;
            $permissions = $role['permissions'] ?? [];

            $role = new Role();
            $role->name = $name;

            if($slug) {
                $role->slug = $slug;
            }

            $role->save();

            foreach ($permissions as $permission) {
                $permission = Permission::getSlug($permission);
                $role->permissions()->attach($permission);
            }
        }
    }
}
