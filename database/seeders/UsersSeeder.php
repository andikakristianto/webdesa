<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            "name" => "Admin",
            "role" => "admin",
            "email" => "123@gmail.com",
            "password" => Hash::make("123"),
            "nik" => "",
        ]);
        User::create([
            "name" => "Danu",
            "role" => "user",
            "email" => "1243",
            "password" => Hash::make("123"),
            "nik" => "123",
        ]);
    }
}
