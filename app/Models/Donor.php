<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donor extends Model
{
    use HasFactory;

    // Field yang boleh diisi secara massal
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
    ];
}
