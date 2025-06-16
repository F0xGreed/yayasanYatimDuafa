<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicDonation extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'email',
        'telepon',
        'nominal',
        'pesan',
        'order_id',
        'status',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
