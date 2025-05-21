<?php

namespace Database\Seeders;

use App\Models\Toko;
use Illuminate\Database\Seeder;

class TokoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $toko = [
            [
                'nama_toko' => 'Toko Pusat Jakarta',
                'alamat' => 'Jl. Sudirman No. 100',
                'kota' => 'Jakarta',
                'no_telepon' => '021-5550123',
                'email' => 'jakarta@tokoretail.com',
            ],
            [
                'nama_toko' => 'Toko Cabang Bandung',
                'alamat' => 'Jl. Asia Afrika No. 77',
                'kota' => 'Bandung',
                'no_telepon' => '022-4230567',
                'email' => 'bandung@tokoretail.com',
            ],
            [
                'nama_toko' => 'Toko Cabang Surabaya',
                'alamat' => 'Jl. Pemuda No. 55',
                'kota' => 'Surabaya',
                'no_telepon' => '031-5478901',
                'email' => 'surabaya@tokoretail.com',
            ],
            [
                'nama_toko' => 'Toko Cabang Medan',
                'alamat' => 'Jl. Imam Bonjol No. 33',
                'kota' => 'Medan',
                'no_telepon' => '061-4563210',
                'email' => 'medan@tokoretail.com',
            ],
            [
                'nama_toko' => 'Toko Cabang Makassar',
                'alamat' => 'Jl. Urip Sumoharjo No. 22',
                'kota' => 'Makassar',
                'no_telepon' => '0411-876543',
                'email' => 'makassar@tokoretail.com',
            ],
        ];

        foreach ($toko as $data) {
            Toko::create($data);
        }
    }
} 