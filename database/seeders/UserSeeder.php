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
        User::create([
            "name" => "Administrator",
            "email" => "admin@gmail.com",
            "password" => bcrypt("password"),
            "role" => "OWNER"
        ]);

        User::create([
            "name" => "Staff",
            "email" => "staff@gmail.com",
            "password" => bcrypt("password"),
            "role" => "STAFF"
        ]);

        User::create([
            "name" => "Pembeli",
            "email" => "pembeli@gmail.com",
            "password" => bcrypt("password"),
            "role" => "PEMBELI"
        ]);
    }
}
