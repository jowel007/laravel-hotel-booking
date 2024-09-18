<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([

            // admin
            [
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin8046'),
                'role' => 'admin',
                'status' => 'active',
            ],

            // user

            [
                'name' => 'User',
                'email' => 'user@user.com',
                'password' => Hash::make('user8046'),
                'role' => 'user',
                'status' => 'active',
            ],
        ]);
    }
}
