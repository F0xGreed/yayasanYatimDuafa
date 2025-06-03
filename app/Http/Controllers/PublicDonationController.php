<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PublicDonation;
use Midtrans\Snap;
use Midtrans\Config;

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

        // Simpan donasi sementara
        $donation = PublicDonation::create($validated);

        // Konfigurasi Midtrans
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $transaction = [
            'transaction_details' => [
                'order_id' => 'PUB-' . $donation->id . '-' . time(),
                'gross_amount' => $donation->nominal,
            ],
            'customer_details' => [
                'first_name' => $donation->nama,
                'email' => $donation->email,
                'phone' => $donation->telepon,
            ],
        ];

        $snapToken = Snap::getSnapToken($transaction);

        return view('donasi.snap', compact('snapToken'));
    }
}
