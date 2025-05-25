<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donasi extends Model
{
    // Hubungkan ke tabel yang benar
    protected $table = 'donations';

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'nama',
        'email',
        'telepon',
        'nominal',
        'pesan',
        'campaign_id', // relasi jika donasi ke kampanye
    ];

    // Relasi ke Campaign (jika ada)
    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}
