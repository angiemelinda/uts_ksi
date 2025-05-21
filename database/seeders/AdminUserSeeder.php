<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createOrUpdateUser([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => 'password',
            'role' => 'admin',
        ]);

        $this->createOrUpdateUser([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => 'adminpassword',
            'role' => 'admin',
        ]);
    }

    /**
     * Create a user or update if it already exists
     */
    private function createOrUpdateUser(array $userData): void
    {
        $user = User::firstWhere('email', $userData['email']);

        // Hash the password
        $userData['password'] = Hash::make($userData['password']);
        $userData['email_verified_at'] = now();

        if ($user) {
            $user->update($userData);
            $this->command->info("User {$userData['email']} updated.");
        } else {
            User::create($userData);
            $this->command->info("User {$userData['email']} created.");
        }
    }
} 