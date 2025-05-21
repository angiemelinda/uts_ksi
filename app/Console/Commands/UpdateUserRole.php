<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class UpdateUserRole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-user-role {email} {role}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update a user\'s role (admin or staff)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        $role = $this->argument('role');

        // Validate role input
        if (!in_array($role, ['admin', 'staff'])) {
            $this->error("Invalid role. Role must be either 'admin' or 'staff'.");
            return;
        }

        // Find the user
        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error("User with email {$email} not found.");
            return;
        }

        // Update the role
        $user->role = $role;
        $user->save();

        $this->info("User {$email} role updated to: {$role}");
    }
}
