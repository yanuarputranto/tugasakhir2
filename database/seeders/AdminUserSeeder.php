<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Super Travel',
            'email' => 'admin@gamil.com',
            'password' => Hash::make('admin123'),  // Ganti 'yourpassword' dengan password yang Anda inginkan
        ]);
    }
}
