<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Zonasi;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $zonasiList = [
            "Zona Industri",
            "Zona Sarana Pelayanan Kawasan",
            "Zona Pariwisata",
            "Zona Logistik",
            "Zona Ruang Terbuka Hijau",
        ];

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
        ]);


        foreach ($zonasiList as $zonasi) {
            Zonasi::create([
                'nama' => $zonasi,
            ]);
        };
    }
}
