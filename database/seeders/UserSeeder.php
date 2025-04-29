<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'Nipha',
            'email' => 'Nipha@gmail.com',
            'password' => Hash::make('123456'), // Always hash the password!
            "phone" => "12345678",
            "address" => "123 Main Street",
        ]);
    }
}
