<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name' => 'Developer',
            'last_name' => '',
            'email' => 'dev@dev.dev',
            'password' => Hash::make('dev'),
        ]);

        User::create([
            'first_name' => 'Admin',
            'last_name' => '',
            'email' => 'admin@admin.admin',
            'password' => Hash::make('admin'),
        ]);
    }
}
