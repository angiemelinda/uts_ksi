<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call seeders in the right order considering database dependencies
        $this->call([
            // Users first (needed for activity logs)
            AdminUserSeeder::class,
            UserSeeder::class,
            
            // Customers and stores (needed for transactions)
            PelangganSeeder::class,
            AlamatPelangganSeeder::class,
            TokoSeeder::class,
            
            // Transactions (depend on customers and stores)
            TransaksiSeeder::class,
            
            // Activity logs (depend on users and other entities)
            AktivitasSeeder::class,
        ]);
    }
}
