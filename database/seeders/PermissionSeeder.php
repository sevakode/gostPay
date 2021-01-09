<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Console\Command;
use Illuminate\Database\Console\Migrations\RefreshCommand;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\RefreshDatabaseState;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Permission::ALL as $permission)
        {
            $name = $permission['title'];
            $slug = $permission['slug'] ?? false;

            $permission = new Permission();
            $permission->name = $name;

            if($slug) $permission->slug = $slug;
            $permission->save();
        }

    }
}
