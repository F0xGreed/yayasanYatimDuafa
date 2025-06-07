<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;
use App\Models\PublicDonation;

class PaymentController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        Config::$curlOptions = [
            CURLOPT_CAINFO => 'C:/laragon/etc/ssl/cacert.pem',
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Accept: application/json'
            ]
        ];
    }

    public function pay(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255',
            'telepon'  => 'nullable|string|max:20',
            'amount'   => 'required|numeric|min:1000',
            'message'  => 'nullable|string|max:500',
        ]);

        try {
            $donation = PublicDonation::create([
                'nama'    => $validated['name'],
                'email'   => $validated['email'],
                'telepon' => $validated['telepon'] ?? '-',
                'nominal' => $validated['amount'],
                'pesan'   => $validated['message'] ?? '-',
            ]);

            if (!$donation || !$donation->id) {
                \Log::error('Gagal menyimpan donasi!', ['data' => $donation]);
                abort(500, 'Donasi gagal disimpan.');
            }

            $orderId = 'DON-' . $donation->id . '-' . time();

            // Simpan order_id dan status awal
            $donation->order_id = $orderId;
            $donation->status = 'pending';
            $donation->save();

            session()->flash('order_id', $orderId);

            $params = [
                'transaction_details' => [
                    'order_id' => $orderId,
                    'gross_amount' => (int) round($donation->nominal),
                ],
                'customer_details' => [
                    'first_name' => $donation->nama,
                    'email' => $donation->email,
                ],
            ];

            \Log::info('Proses Midtrans', ['params' => $params]);

            $response = Snap::createTransaction($params);
            $snapToken = $response->token;

            return view('payment.snap', compact('snapToken'));
        } catch (\Exception $e) {
            \Log::error('Error saat proses donasi publik', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            abort(500, 'Terjadi kesalahan saat memproses donasi.');
        }
    }

    public function handleNotification(Request $request)
{
    try {
        
        \Log::info('🔔 Notifikasi Midtrans Masuk!', [
            'method' => $request->method(),
            'headers' => $request->headers->all(),
            'body' => $request->getContent(),
        ]);

        \Midtrans\Config::$serverKey = config('services.midtrans.server_key');
        \Midtrans\Config::$isProduction = config('services.midtrans.is_production');

        $notification = new \Midtrans\Notification();

        $transaction = $notification->transaction_status;
        $orderId = $notification->order_id;

        \Log::info('📦 Update status order', [
            'order_id' => $orderId,
            'status' => $transaction,
        ]);

        $donation = \App\Models\PublicDonation::where('order_id', $orderId)->first();
        if ($donation) {
            $donation->status = $transaction;
            $donation->save();
            \Log::info("✅ Order {$orderId} status updated to {$transaction}");
        } else {
            \Log::warning("❌ Order ID {$orderId} not found");
        }

        return response()->json(['message' => 'OK']);
    } catch (\Exception $e) {
        \Log::error('❌ ERROR dari Midtrans Notification: ' . $e->getMessage(), [
            'trace' => $e->getTraceAsString()
        ]);
        return response()->json(['error' => 'Server error'], 500);
    }
}


}
