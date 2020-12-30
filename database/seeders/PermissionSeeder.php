<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Permission::ALL as $permissionList)
        {
            $name = $permissionList[0];
            $slug = $permissionList[1] ?? false;

            $permission = new Permission();
            $permission->name = $name;

            if($slug) {
                $permission->slug = $slug;
            }
            $permission->save();
        }

    }
}
