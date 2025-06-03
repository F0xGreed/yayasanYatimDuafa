<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pengeluaran;
use Illuminate\Support\Carbon;

class PengeluaranSeeder extends Seeder
{
    public function run()
    {
        $kategori = ['Operasional', 'Program', 'Kegiatan Sosial', 'Transportasi', 'Administrasi'];

        for ($i = 1; $i <= 30; $i++) {
            Pengeluaran::create([
                'tanggal' => Carbon::now()->subDays(rand(1, 90))->format('Y-m-d'),
                'deskripsi' => 'Pengeluaran ke-' . $i,
                'jumlah' => rand(10000, 500000),
                'kategori' => $kategori[array_rand($kategori)],
            ]);
        }
    }
}
