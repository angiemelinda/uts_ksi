<?php

namespace Database\Seeders;

use App\Models\Aktivitas;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AktivitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $aktivitas = [
            [
                'user_id' => 1,
                'aksi' => 'create',
                'entitas' => 'Pelanggan',
                'entitas_id' => 1,
                'waktu' => Carbon::now()->subDays(30),
            ],
            [
                'user_id' => 1,
                'aksi' => 'create',
                'entitas' => 'Transaksi',
                'entitas_id' => 1,
                'waktu' => Carbon::now()->subDays(30),
            ],
            [
                'user_id' => 2,
                'aksi' => 'update',
                'entitas' => 'Pelanggan',
                'entitas_id' => 2,
                'waktu' => Carbon::now()->subDays(25),
            ],
            [
                'user_id' => 2,
                'aksi' => 'create',
                'entitas' => 'Transaksi',
                'entitas_id' => 2,
                'waktu' => Carbon::now()->subDays(25),
            ],
            [
                'user_id' => 1,
                'aksi' => 'create',
                'entitas' => 'Toko',
                'entitas_id' => 5,
                'waktu' => Carbon::now()->subDays(20),
            ],
            [
                'user_id' => 2,
                'aksi' => 'update',
                'entitas' => 'Toko',
                'entitas_id' => 3,
                'waktu' => Carbon::now()->subDays(15),
            ],
            [
                'user_id' => 1,
                'aksi' => 'create',
                'entitas' => 'AlamatPelanggan',
                'entitas_id' => 6,
                'waktu' => Carbon::now()->subDays(10),
            ],
            [
                'user_id' => 2,
                'aksi' => 'update',
                'entitas' => 'Transaksi',
                'entitas_id' => 5,
                'waktu' => Carbon::now()->subDays(5),
            ],
            [
                'user_id' => 1,
                'aksi' => 'create',
                'entitas' => 'Transaksi',
                'entitas_id' => 9,
                'waktu' => Carbon::now()->subDays(2),
            ],
            [
                'user_id' => 2,
                'aksi' => 'update',
                'entitas' => 'Pelanggan',
                'entitas_id' => 4,
                'waktu' => Carbon::now()->subDay(),
            ],
        ];

        foreach ($aktivitas as $data) {
            Aktivitas::create($data);
        }
    }
} 