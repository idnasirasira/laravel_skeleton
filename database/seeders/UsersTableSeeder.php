<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
