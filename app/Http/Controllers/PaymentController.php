<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;
use App\Models\PublicDonation;
use App\Models\Campaign;
use App\Models\CampaignDonation;
use Illuminate\Support\Facades\Mail;
use App\Mail\DonasiBerhasilMail;

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

    /**
     * Proses donasi publik (donasi umum tanpa kampanye).
     */
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
                'user_id' => auth()->id(),
                'nama'    => $validated['name'],
                'email'   => $validated['email'],
                'telepon' => $validated['telepon'] ?? '-',
                'nominal' => $validated['amount'],
                'pesan'   => $validated['message'] ?? '-',
            ]);

            $orderId = 'DON-' . $donation->id . '-' . time();
            $donation->order_id = $orderId;
            $donation->status = 'pending';
            $donation->save();

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

            \Log::info('📤 Proses Donasi Publik ke Midtrans', $params);
            $snapToken = Snap::createTransaction($params)->token;

            return view('payment.snap', compact('snapToken'));
        } catch (\Exception $e) {
            \Log::error('❌ Gagal Proses Donasi Publik', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            abort(500, 'Terjadi kesalahan saat memproses donasi.');
        }
    }

    /**
     * Proses donasi kampanye.
     */
    public function payCampaign(Request $request, $campaignId)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'telepon' => 'required|string|max:20',
            'nominal' => 'required|numeric|min:1000',
            'pesan' => 'nullable|string|max:500',
        ]);

        $campaign = Campaign::findOrFail($campaignId);

        $donation = CampaignDonation::create([
            'user_id'     => auth()->id(),
            'campaign_id' => $campaign->id,
            'nama'        => $validated['nama'],
            'email'       => $validated['email'],
            'telepon'     => $validated['telepon'],
            'nominal'     => $validated['nominal'],
            'pesan'       => $validated['pesan'] ?? '-',
        ]);

        $orderId = 'CMP-' . $donation->id . '-' . time();
        $donation->order_id = $orderId;
        $donation->status = 'pending';
        $donation->save();

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

        \Log::info('📤 Proses Donasi Kampanye ke Midtrans', $params);
        $snapToken = Snap::createTransaction($params)->token;

        return view('payment.snap', compact('snapToken'));
    }

    /**
     * Menangani notifikasi dari Midtrans.
     */
    
public function handleNotification(Request $request)
{
    try {
        \Log::info('🔔 Midtrans Notification Masuk', [
            'method' => $request->method(),
            'body' => $request->getContent(),
        ]);

        $notification = new Notification();
        $transaction = $notification->transaction_status;
        $orderId = $notification->order_id;

        \Log::info("📦 Update status transaksi untuk order_id {$orderId}", [
            'status' => $transaction,
        ]);

        if (str_starts_with($orderId, 'DON-')) {
            $donation = PublicDonation::where('order_id', $orderId)->first();
        } elseif (str_starts_with($orderId, 'CMP-')) {
            $donation = CampaignDonation::where('order_id', $orderId)->first();
        } else {
            \Log::warning("⚠️ Order ID tidak dikenali: {$orderId}");
            return response()->json(['error' => 'Unknown order ID'], 400);
        }

        if ($donation) {
            $donation->status = $transaction;
            $donation->save();

            if ($transaction === 'settlement') {
                Mail::to($donation->email)->send(new DonasiBerhasilMail($donation));
                \Log::info("✉️ Email berhasil dikirim ke {$donation->email}");
            }

            \Log::info("✅ Order {$orderId} diperbarui ke status {$transaction}");
        } else {
            \Log::warning("❌ Donasi tidak ditemukan untuk order ID {$orderId}");
        }

        return response()->json(['message' => 'OK']);
    } catch (\Exception $e) {
        \Log::error('❌ Error Notifikasi Midtrans', [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
        ]);
        return response()->json(['error' => 'Server error'], 500);
    }
}


    /**
     * Menampilkan histori donasi (publik & kampanye) oleh user yang login.
     */
    public function historiDonasi()
    {
        $userId = auth()->id();

        $publicDonations = PublicDonation::where('user_id', $userId)->latest()->get();
        $campaignDonations = CampaignDonation::where('user_id', $userId)
            ->with('campaign')
            ->latest()
            ->get();

        return view('anggota.histori_donasi', compact('publicDonations', 'campaignDonations'));
    }
}
