<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Obyy',
            'email' => 'obyy@example.com',
            'password' => Hash::make('admin123'),
        ]);

        $user->createToken('Obyy')->plainTextToken;

        User::factory(5)->create();
    }
}