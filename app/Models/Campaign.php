<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'deskripsi',
        'target_donasi',
        'tanggal_mulai',
        'tanggal_selesai',
        'gambar',
        'total_donasi',
    ];

    // Cast tanggal menjadi instance Carbon otomatis
    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];

    // Relasi ke tabel campaign_donations
    public function donations()
    {
        return $this->hasMany(CampaignDonation::class);
    }

    // Scope: hanya kampanye aktif (opsional untuk kemudahan query)
    public function scopeAktif($query)
    {
        return $query->whereDate('tanggal_selesai', '>=', Carbon::today());
    }

    // Accessor: URL gambar kampanye (jika ada)
    public function getGambarUrlAttribute()
    {
        return $this->gambar ? asset('storage/' . $this->gambar) : null;
    }
}
