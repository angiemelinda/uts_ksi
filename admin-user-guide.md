# Admin User Management Guide

This document explains how to create and manage admin users in the system.

## Using the Admin User Seeder

We've created a dedicated seeder for creating admin users. The seeder creates two admin accounts:

1. **Default Admin**:
   - Email: admin@example.com
   - Password: password
   
2. **Super Admin**:
   - Email: superadmin@example.com
   - Password: adminpassword

To run the seeder, execute:

```bash
php artisan db:seed --class=AdminUserSeeder
```

## Using the Admin Creation Command

For more flexibility, you can use the dedicated command to create admin users with custom details:

```bash
# Basic usage (will prompt for details)
php artisan admin:create

# With arguments
php artisan admin:create "Admin Name" "admin@example.com" "secure_password"
```

This command will:
- Create a new admin if the email doesn't exist
- Ask to update the existing admin if the email already exists

## Other Available Commands

The system also has these user management commands:

```bash
# List all users
php artisan app:list-users

# Update a user's role
php artisan app:update-user-role [email] [role]
```

## Admin Login

Once you've created an admin user, you can login at:

```
http://your-app-url/admin
```

Admin users have full access to the system's administration panel. 