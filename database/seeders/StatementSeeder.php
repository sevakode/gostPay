<?php

namespace Database\Seeders;

use App\Models\Bank\Statement;
use App\Models\Role;
use Illuminate\Database\Seeder;

class StatementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @var Role $ownerRole
     * @return void
     */
    public function run()
    {
        Statement::refreshApi();
    }
}
