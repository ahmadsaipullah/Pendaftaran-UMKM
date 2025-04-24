<?php

namespace Database\Seeders;

use App\Models\Umkm;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class UmkmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dummyUmkm = [
            [
                'user_id' => 1,
                'nama_umkm' => 'Dapoer Nusantara',
                'jenis_usaha' => 'Kuliner',
                'alamat_umkm' => 'Jl. Melati No. 12',
                'kelurahan' => 'Cikokol',

            ],
            [
                'user_id' => 1,
                'nama_umkm' => 'Craft by Ina',
                'jenis_usaha' => 'Kerajinan Tangan',
                'alamat_umkm' => 'Jl. Kenanga No. 45',
                'kelurahan' => 'Sudimara',

            ],
            [
                'user_id' => 1,
                'nama_umkm' => 'Fresh Farm',
                'jenis_usaha' => 'Pertanian Organik',
                'alamat_umkm' => 'Jl. Sawah Indah No. 23',
                'kelurahan' => 'Bojong',

            ],
            [
                'user_id' => 1,
                'nama_umkm' => 'Sari Batik',
                'jenis_usaha' => 'Konveksi',
                'alamat_umkm' => 'Jl. Batik Cirebon No. 10',
                'kelurahan' => 'Panunggangan',

            ],
            [
                'user_id' => 1,
                'nama_umkm' => 'Kopi Kita',
                'jenis_usaha' => 'Kedai Kopi',
                'alamat_umkm' => 'Jl. Raya Serpong No. 88',
                'kelurahan' => 'Pondok Jagung',

            ],
            [
                'user_id' => 1,
                'nama_umkm' => 'Bersih Laundry',
                'jenis_usaha' => 'Laundry',
                'alamat_umkm' => 'Jl. Merdeka No. 7',
                'kelurahan' => 'Poris',

            ],
            [
                'user_id' => 1,
                'nama_umkm' => 'Roti Manis',
                'jenis_usaha' => 'Bakery',
                'alamat_umkm' => 'Jl. Mawar No. 18',
                'kelurahan' => 'Bencongan',

            ],
            [
                'user_id' => 1,
                'nama_umkm' => 'Dewi Salon',
                'jenis_usaha' => 'Kecantikan',
                'alamat_umkm' => 'Jl. Anggrek No. 9',
                'kelurahan' => 'Gondrong',

            ],
            [
                'user_id' => 1,
                'nama_umkm' => 'Tirta Air Minum',
                'jenis_usaha' => 'Depot Air Minum',
                'alamat_umkm' => 'Jl. Raya Mauk No. 27',
                'kelurahan' => 'Mauk',

            ],
            [
                'user_id' => 1,
                'nama_umkm' => 'Hijab Queen',
                'jenis_usaha' => 'Fashion Muslim',
                'alamat_umkm' => 'Jl. KH Hasyim Ashari No. 14',
                'kelurahan' => 'Pakojan',

            ],
        ];

        foreach ($dummyUmkm as $umkm) {
            Umkm::create($umkm);
        }
    }
}
