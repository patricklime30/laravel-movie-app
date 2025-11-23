<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::updateOrCreate(
            ['email' => 'movie_admin@mail.com'],  // Prevent duplicates
            [
                'name' => 'Movie Admin',
                'password' => Hash::make('movie_admin12')
            ]
        );

        $user->assignRole('admin');
    }
}
