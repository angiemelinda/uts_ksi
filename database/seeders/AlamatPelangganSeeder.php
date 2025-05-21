<?php

namespace Database\Seeders;

use App\Models\AlamatPelanggan;
use Illuminate\Database\Seeder;

class AlamatPelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $alamat = [
            [
                'pelanggan_id' => 1,
                'jalan' => 'Jl. Merdeka No. 123',
                'kota' => 'Jakarta',
                'provinsi' => 'DKI Jakarta',
                'kode_pos' => '10110',
            ],
            [
                'pelanggan_id' => 2,
                'jalan' => 'Jl. Diponegoro No. 45',
                'kota' => 'Bandung',
                'provinsi' => 'Jawa Barat',
                'kode_pos' => '40115',
            ],
            [
                'pelanggan_id' => 3,
                'jalan' => 'Jl. Pahlawan No. 67',
                'kota' => 'Surabaya',
                'provinsi' => 'Jawa Timur',
                'kode_pos' => '60175',
            ],
            [
                'pelanggan_id' => 4,
                'jalan' => 'Jl. Gatot Subroto No. 89',
                'kota' => 'Medan',
                'provinsi' => 'Sumatera Utara',
                'kode_pos' => '20217',
            ],
            [
                'pelanggan_id' => 5,
                'jalan' => 'Jl. Ahmad Yani No. 12',
                'kota' => 'Makassar',
                'provinsi' => 'Sulawesi Selatan',
                'kode_pos' => '90231',
            ],
            // Multiple addresses for one customer
            [
                'pelanggan_id' => 1,
                'jalan' => 'Jl. Thamrin No. 50',
                'kota' => 'Jakarta',
                'provinsi' => 'DKI Jakarta',
                'kode_pos' => '10350',
            ],
        ];

        foreach ($alamat as $data) {
            AlamatPelanggan::create($data);
        }
    }
} 