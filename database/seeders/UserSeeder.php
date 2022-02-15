<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
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
        $u1 = User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'password' => Hash::make('password'),
        ]);
        $u1->assignRole('admin');

        $u2 = User::create([
            'name' => 'Guru',
            'username' => 'guru',
            'email' => 'guru@gmail.com',
            'phone' => '082234897335',
            'password' => Hash::make('password'),
        ]);
        $u2->assignRole('teacher');
    }
}
