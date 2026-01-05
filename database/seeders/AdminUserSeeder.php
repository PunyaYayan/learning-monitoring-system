<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'phone' => '0800000000',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Miss Fitri',
            'email' => 'fitria@gmail.com',
            'phone' => '089876787899',
            'password' => bcrypt('password'),
            'role' => 'guru',
        ]);

        User::create([
            'name' => 'Miss Dwi',
            'email' => 'dwia@gmail.com',
            'phone' => '089876787699',
            'password' => bcrypt('password'),
            'role' => 'guru',
        ]);

        // STUDENT
        User::create([
            'name' => 'Tegar',
            'email' => null,
            'phone' => '088888777777',
            'password' => bcrypt('password'),
            'role' => 'student',
        ]);

        // ORTU TEGAR
        User::create([
            'name' => 'Bapaknya Tegar',
            'email' => 'tegar@ar.com',
            'phone' => '088888777789',
            'password' => bcrypt('password'),
            'role' => 'ortu',
        ]);

        // STUDENT
        User::create([
            'name' => 'Yayan',
            'email' => null,
            'phone' => '085155555555',
            'password' => bcrypt('password'),
            'role' => 'student',
        ]);

        // ORTU APIP
        User::create([
            'name' => 'Bapaknya Apip',
            'email' => null,
            'phone' => '085432215699',
            'password' => bcrypt('password'),
            'role' => 'ortu',
        ]);
    }
}
