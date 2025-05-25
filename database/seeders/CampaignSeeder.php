<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Campaign;
use Carbon\Carbon;

class CampaignSeeder extends Seeder
{
    public function run(): void
    {
        foreach (range(1, 3) as $i) {
                Campaign::create([
                'judul' => 'Kampanye Bantuan 1',
                'deskripsi' => 'Deskripsi kampanye ke-1',
                'target_donasi' => 4019527,
                'tanggal_mulai' => now()->subDays(30),
                'tanggal_selesai' => now()->addMonth(), // Ganti dari batas_akhir
            ]);

        }
    }
}
