<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PublicDonation;

class PublicDonationController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'telepon' => 'nullable|string|max:20',
            'nominal' => 'required|numeric|min:1000',
            'pesan' => 'nullable|string|max:500',
        ]);

        PublicDonation::create($validated);

        return redirect()->route('donasi')->with('success', 'Terima kasih atas donasi Anda!');
    }
}
