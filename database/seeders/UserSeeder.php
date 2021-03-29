<?php

namespace Database\Seeders;

use App\Models\User;
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
        User::create([
            'name' => 'Admin',
            'email' => 'admin@email.com',
            'password' => Hash::make('admin12345'),
            'is_admin' => true,
        ]);
        User::create([
            'name' => 'Test',
            'email' => 'test@email.com',
            'password' => Hash::make('test12345'),
            'is_admin' => false,
        ]);
    }
}
