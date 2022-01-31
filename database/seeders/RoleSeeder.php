<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
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
            $slug = $role['slug'] ?? Str::slug($role['title']);
            $permissions = $role['permissions'] ?? [];

            $role = new Role();
            $role->name = $name;

            if($slug) {
                $role->slug = $slug;
            }
            if (!Role::query()->where('slug', $slug)->exists()) $role->save();

            foreach ($permissions as $permission) {
                $permission = Permission::getSlug($permission);
                $role = Role::where('slug', $slug)->first();
                if (! $role->permissions()->where('slug', $permission->slug)->exists()) {
                    $role->permissions()->attach($permission);
                }
            }
        }
    }
}
