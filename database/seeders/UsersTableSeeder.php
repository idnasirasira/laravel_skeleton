<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make(123456789),
            'email_verified_at' => now(),
        ]);

        User::factory()->count(10)->create();

        // Assign Role
        $users = User::all();

        foreach ($users as $key => $user) {
            if ($key == 0) {
                $user->assignRole('admin');
            } else {
                $user->assignRole('user');
            }
        }
    }
}
