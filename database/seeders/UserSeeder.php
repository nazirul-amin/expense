<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                'name' => 'Admin',
                'email' => 'admin@email.com',
                'password' => Hash::make('admin12345'),
            ],
            [
                'name' => 'Test',
                'email' => 'test@email.com',
                'password' => Hash::make('test12345'),
            ],
        );
    }
}
