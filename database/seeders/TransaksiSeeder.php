<?php

namespace Database\Seeders;

use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transaksi = [
            [
                'pelanggan_id' => 1,
                'toko_id' => 1,
                'tanggal' => Carbon::now()->subDays(30),
                'total' => 500000.00,
                'status' => 'selesai',
            ],
            [
                'pelanggan_id' => 2,
                'toko_id' => 2,
                'tanggal' => Carbon::now()->subDays(25),
                'total' => 750000.00,
                'status' => 'selesai',
            ],
            [
                'pelanggan_id' => 3,
                'toko_id' => 3,
                'tanggal' => Carbon::now()->subDays(20),
                'total' => 300000.00,
                'status' => 'selesai',
            ],
            [
                'pelanggan_id' => 4,
                'toko_id' => 4,
                'tanggal' => Carbon::now()->subDays(15),
                'total' => 1250000.00,
                'status' => 'selesai',
            ],
            [
                'pelanggan_id' => 5,
                'toko_id' => 5,
                'tanggal' => Carbon::now()->subDays(10),
                'total' => 850000.00,
                'status' => 'selesai',
            ],
            [
                'pelanggan_id' => 1,
                'toko_id' => 1,
                'tanggal' => Carbon::now()->subDays(5),
                'total' => 420000.00,
                'status' => 'selesai',
            ],
            [
                'pelanggan_id' => 2,
                'toko_id' => 3,
                'tanggal' => Carbon::now()->subDays(3),
                'total' => 650000.00,
                'status' => 'pending',
            ],
            [
                'pelanggan_id' => 3,
                'toko_id' => 2,
                'tanggal' => Carbon::now()->subDays(2),
                'total' => 900000.00,
                'status' => 'pending',
            ],
            [
                'pelanggan_id' => 4,
                'toko_id' => 1,
                'tanggal' => Carbon::now()->subDay(),
                'total' => 1100000.00,
                'status' => 'pending',
            ],
            [
                'pelanggan_id' => 5,
                'toko_id' => 4,
                'tanggal' => Carbon::now(),
                'total' => 550000.00,
                'status' => 'pending',
            ],
        ];

        foreach ($transaksi as $data) {
            Transaksi::create($data);
        }
    }
} 