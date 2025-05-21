<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create {name?} {email?} {password?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new admin user with optional custom credentials';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name') ?? $this->ask('Enter admin name', 'Admin');
        $email = $this->argument('email') ?? $this->ask('Enter admin email', 'admin@example.com');
        $password = $this->argument('password') ?? $this->secret('Enter admin password') ?? 'password';

        // Check if user with this email already exists
        $existingUser = User::where('email', $email)->first();
        
        if ($existingUser) {
            if ($this->confirm("User with email {$email} already exists. Do you want to update it?", true)) {
                $existingUser->update([
                    'name' => $name,
                    'password' => Hash::make($password),
                    'role' => 'admin',
                    'email_verified_at' => now(),
                ]);
                $this->info("Admin user {$email} has been updated.");
                return;
            } else {
                $this->error("Operation cancelled.");
                return;
            }
        }

        // Create new user
        User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        $this->info("Admin user {$email} has been created successfully.");
    }
}
