<?php

namespace Database\Seeders;

use App\Models\User;
# use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userRegisterLogin = [
            [
                "name" => "admin",
                "email" => "admin@gmail.com",
                "password" => Hash::make('123'),
            ], [
                "name" => "user",
                "email" => "user@gmail.com",
                "password" => Hash::make('123'),
            ],
        ];

        foreach ($userRegisterLogin as $url) {
            User::create($url);
        }
    }
}


