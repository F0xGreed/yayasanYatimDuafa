<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignDonation extends Model
{
    use HasFactory;

    protected $fillable = [
        'campaign_id',
        'nama',
        'email',
        'telepon',
        'nominal',
        'pesan',
    ];

    // Relasi ke campaign
    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}
