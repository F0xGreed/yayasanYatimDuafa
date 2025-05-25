<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PublicDonation;
use Carbon\Carbon;

class PublicDonationSeeder extends Seeder
{
    public function run(): void
    {
        foreach (range(1, 12) as $month) {
            PublicDonation::create([
                'nama' => 'Donatur Bulan ' . $month,
                'nominal' => rand(50000, 200000),
                'pesan' => 'Terima kasih',
                'created_at' => Carbon::create(2025, $month, rand(1, 28)),
            ]);
        }
    }
}
