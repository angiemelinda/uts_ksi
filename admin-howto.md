# Admin Panel Instructions

This application provides a complete admin panel that integrates with Filament. Here are the instructions for login and setup.

## Accessing the Admin Panel

1. Make sure the Laravel application is running:
   ```
   php artisan serve
   ```

2. Visit the admin panel URL: http://127.0.0.1:8000/admin

## User Management

### Creating an Admin User

Use the following command to create an admin user:

```
php artisan app:create-admin-user [email] [password]
```

Example:
```
php artisan app:create-admin-user admin@example.com password123
```

### Listing Users

To see a list of all users in the system:

```
php artisan app:list-users
```

### Updating User Role

To change a user's role between admin and staff:

```
php artisan app:update-user-role [email] [role]
```

Example:
```
php artisan app:update-user-role admin@example.com admin
```

## Default Credentials

Default admin user:
- Email: admin@example.com
- Password: password123
- Role: admin

## User Roles

1. **Admin**
   - Full access to all resources
   - Can manage other users

2. **Staff**
   - Can perform daily operations
   - Limited access based on configuration

## Business Flow

The application supports the following business flow:

1. **Customer Management** - Track customer information and addresses
2. **Store Management** - Manage store locations and details
3. **Transaction Management** - Record transactions between customers and stores
4. **User Management** - Manage system users with different roles
5. **Activity Logging** - Track all CRUD operations for auditing purposes 