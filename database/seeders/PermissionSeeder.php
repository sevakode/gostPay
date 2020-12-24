<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        Permission::truncate();
        $permission = new Permission();
        $permission->name = 'test 1';
        $permission->slug = Str::slug($permission->name);
        $permission->save();

        $permission = new Permission();
        $permission->name = 'test 2';
        $permission->slug = Str::slug($permission->name);
        $permission->save();
    }
}
