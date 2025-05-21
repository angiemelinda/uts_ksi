<?php

namespace Database\Seeders;

use App\Models\Pelanggan;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pelanggan = [
            [
                'nama' => 'Budi Santoso',
                'email' => 'budi@example.com',
                'no_telepon' => '08123456789',
                'tanggal_daftar' => Carbon::now()->subMonths(3),
            ],
            [
                'nama' => 'Anisa Wijaya',
                'email' => 'anisa@example.com',
                'no_telepon' => '08234567890',
                'tanggal_daftar' => Carbon::now()->subMonths(2),
            ],
            [
                'nama' => 'Dian Permata',
                'email' => 'dian@example.com',
                'no_telepon' => '08345678901',
                'tanggal_daftar' => Carbon::now()->subMonths(1),
            ],
            [
                'nama' => 'Hendro Kusumo',
                'email' => 'hendro@example.com',
                'no_telepon' => '08456789012',
                'tanggal_daftar' => Carbon::now()->subDays(20),
            ],
            [
                'nama' => 'Siti Rahma',
                'email' => 'siti@example.com',
                'no_telepon' => '08567890123',
                'tanggal_daftar' => Carbon::now()->subDays(10),
            ],
        ];

        foreach ($pelanggan as $data) {
            Pelanggan::create($data);
        }
    }
} 