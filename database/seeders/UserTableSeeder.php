<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            'username' => 'namaku1',
            'email' => 'namaku1@gmail.com',
            'alamat' => 'gunung soputan',
            'no_hp' => '082144723035',
            'is_admin' => '1',
            'password' => Hash::make('123456'),
        ]);
    }
}
