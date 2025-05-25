<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CampaignDonation;
use Carbon\Carbon;
use App\Models\Campaign;

class CampaignDonationSeeder extends Seeder
{
    public function run(): void
    {
        $campaigns = Campaign::all();

        foreach ($campaigns as $campaign) {
            foreach (range(1, 4) as $month) {
                CampaignDonation::create([
                    'campaign_id' => $campaign->id,
                    'nama' => 'Donatur Kampanye ' . $month,
                    'email' => 'kampanye' . $month . '@mail.com',
                    'telepon' => '08123456789',
                    'nominal' => rand(30000, 150000),
                    'created_at' => Carbon::create(2025, $month, rand(1, 28)),
                ]);
            }
        }
    }
}

