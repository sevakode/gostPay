<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles_permissions')->truncate();
        DB::table('permissions_roles')->truncate();
        foreach (Permission::all() as $permission) $permission->delete();
        foreach (Role::all() as $permission) $permission->delete();

        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(RegistrationRoleAndPermissionSeeder::class);
    }
}
