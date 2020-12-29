<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Company();
        $role->name = 'Company 1';
        $role->slug = Str::slug($role->name);
        $role->save();

        $role = new Company();
        $role->name = 'Company 2';
        $role->slug = Str::slug($role->name);
        $role->save();
    }
}
