<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'nomor_induk' => '12345678',
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

        $user->assignRole('operator');

        $user = User::create([
            'nomor_induk' => '123456789',
            'name' => 'users',
            'email' => 'users@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

        $user->assignRole('user');
    }
}
